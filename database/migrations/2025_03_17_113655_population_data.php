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
        Schema::create('population_data', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key (BIGINT UNSIGNED)
            
            // Foreign key referencing `prefectures.id`
            $table->unsignedBigInteger('prefecture_id')->comment('Reference to the prefectures table');
            $table->foreign('prefecture_id')
                  ->references('id')->on('prefectures')
                  ->onDelete('cascade') // Ensures data integrity
                  ->onUpdate('cascade');

            // Year of the population record
            $table->year('year')->comment('Year of the population record');

            // Population count (must be a non-negative integer)
            $table->unsignedBigInteger('population')->comment('Total population for the prefecture and year');

            // Unique index to avoid duplicate records for the same prefecture and year
            $table->unique(['prefecture_id', 'year'], 'unique_population_record');

            // Automatically set the creation timestamp
            $table->timestamp('created_at')->useCurrent()->comment('Record creation timestamp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('population_data'); // Drop table if rollback occurs
    }
};
