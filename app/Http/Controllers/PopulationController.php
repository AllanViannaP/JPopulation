<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prefecture;
use App\Models\PopulationData;

class PopulationController extends Controller
{
    /**
     * Show the index page with dropdowns.
     */
    public function index()
    {
        // Get all prefectures
        $prefectures = Prefecture::orderBy('name')->get();

        // Get all distinct years from the population data
        $years = PopulationData::select('year')->distinct()->orderBy('year', 'desc')->pluck('year');

        return view('index', compact('prefectures', 'years'));
    }

    /**
     * Search population data based on selected prefecture and year.
     */
    public function search(Request $request)
    {
        $request->validate([
            'prefecture_id' => 'required|exists:prefectures,id',
            'year' => 'required|integer',
        ]);

        // Fetch data
        $prefectures = Prefecture::orderBy('name')->get();
        $years = PopulationData::select('year')->distinct()->orderBy('year', 'desc')->pluck('year');
        $selectedPrefecture = Prefecture::findOrFail($request->prefecture_id);
        $selectedYear = $request->year;

        // Find population
        $population = PopulationData::where('prefecture_id', $selectedPrefecture->id)
            ->where('year', $selectedYear)
            ->value('population');

        return view('index', compact('prefectures', 'years', 'selectedPrefecture', 'selectedYear', 'population'));
    }
}
