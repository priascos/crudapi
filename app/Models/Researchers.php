<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Researchers extends Model
{
    use HasFactory;

    protected $table = "researchers";

    protected $fillable = [
      'orcid',
      'given-names',
      'family-names',
      'email',
      'keywords'
    ];
}
