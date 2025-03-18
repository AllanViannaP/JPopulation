<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CsvImport extends Model
{
    use HasFactory;

    protected $table = 'csv_imports';

    public $timestamps = false;

    protected $fillable = ['filename', 'status'];
}
