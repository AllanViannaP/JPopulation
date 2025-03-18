<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopulationData extends Model
{
    use HasFactory;

    public $timestamps = false; 
    
    protected $fillable = ['prefecture_id', 'year', 'population'];
}
