<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prefecture;
use App\Models\PopulationData;
use Illuminate\Support\Facades\DB;

class CsvImportController extends Controller
{
    /**
     * Display the CSV upload form.
     */
    public function showImportForm()
    {
        return view('import');
    }

    /**
     * Handle CSV upload and import data into the database.
     */
    public function importCsv(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        // Get the file path
        $file = $request->file('csv_file');
        $filePath = $file->getPathname();

        // Open the file with the correct encoding (Shift-JIS)
        $handle = fopen($filePath, 'r');

        if (!$handle) {
            return back()->with('error', 'Failed to open CSV file.');
        }

        // Detect the correct header row dynamically
        while (($line = fgetcsv($handle, 1000, ",")) !== false) {
            $line = array_map(fn($col) => mb_convert_encoding($col, "UTF-8", "SJIS-win"), $line);
        
            // Ensure the row has at least two columns before checking
            if (isset($line[1]) && empty($line[0]) && preg_match('/^\d{4}$/', $line[1])) {
                $years = array_slice($line, 1); // Store the year columns
                break;
            }
        }

        if (!isset($years)) {
            fclose($handle);
            return back()->with('error', 'Invalid CSV format. Could not detect the year headers.');
        }

        DB::beginTransaction();
        try {
            // Process each data row
            while (($line = fgetcsv($handle, 1000, ",")) !== false) {
                $line = array_map(fn($col) => mb_convert_encoding($col, "UTF-8", "SJIS-win"), $line);

                // Prefecture name (first column)
                $prefectureName = trim($line[0]);

                if (empty($prefectureName)) {
                    continue; // Skip invalid rows
                }

                // Find or create the prefecture in the database
                $prefecture = Prefecture::firstOrCreate(['name' => $prefectureName]);

                // Insert population data
                for ($i = 1; $i < count($line); $i++) {
                    $year = (int)$years[$i - 1]; // Get the corresponding year
                    $population = (int)str_replace(',', '', $line[$i]); // Remove commas from numbers

                    if ($population > 0) {
                        PopulationData::updateOrCreate(
                            ['prefecture_id' => $prefecture->id, 'year' => $year],
                            ['population' => $population]
                        );
                    }
                }
            }

            fclose($handle);
            DB::commit();
            return back()->with('success', 'CSV imported successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            fclose($handle);
            return back()->with('error', 'Error importing CSV: ' . $e->getMessage());
        }
    }
}
