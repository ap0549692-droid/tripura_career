<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //
   protected $fillable = [
    'title',
    'department',
    'qualification',
    'last_date',
    'apply_link',
    'pdf_link',
    'image',
    'category'
];
}
