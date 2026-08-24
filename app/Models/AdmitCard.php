<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AdmitCard extends Model
{
    protected $fillable = ['title','department','exam_date','admit_link','description'];
}