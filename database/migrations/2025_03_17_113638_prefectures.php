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
        Schema::create('prefectures', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key (BIGINT UNSIGNED)
            
            // Prefecture name (must be unique to prevent duplicates)
            $table->string('name', 100)->unique()->comment('Unique name of the Japanese prefecture');
            
            // Automatically set the creation timestamp
            $table->timestamp('created_at')->useCurrent()->comment('Record creation timestamp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('prefectures'); // Drop table if rollback occurs
    }
};
