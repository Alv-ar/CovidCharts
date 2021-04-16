<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dades extends Model
{
    use HasFactory;

    protected $table = 'dades';
    public $primaryKey = 'date';
    public $timestamps = 'false';
    
}
