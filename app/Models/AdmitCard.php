<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmitCard extends Model
{
    protected $table = 'admit_cards';

    protected $fillable = [
        'title',
        'link',
        'description',
    ];
}