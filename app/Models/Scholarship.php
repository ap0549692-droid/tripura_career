<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    protected $fillable = [
        'title',
        'provider',
        'category',
        'amount',
        'last_date',
        'deadline',
        'apply_link',
        'description'
    ];
}