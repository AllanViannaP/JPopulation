<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('csv_imports', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key (BIGINT UNSIGNED)
            
            // File name of the imported CSV
            $table->string('filename', 255)->comment('Name of the uploaded CSV file');

            // Import status (Pending, Completed, Failed)
            $table->enum('status', ['pending', 'completed', 'failed'])
                  ->default('pending')
                  ->comment('Status of the CSV import process');

            // Automatically set the creation timestamp
            $table->timestamp('created_at')->useCurrent()->comment('Record creation timestamp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('csv_imports'); // Drop table if rollback occurs
    }
};
