<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory;
    
    protected $fillable = ['title','department','location','qualification','category','description','apply_link','last_date','syllabus_link','pyq_link','min_age','max_age','documents','prtc_required'];

    protected $casts = [
        'last_date' => 'date',
    ];

    // Auto Syllabus link dega, DB khali bhi ho to
public function getAutoSyllabusAttribute(){
    $dept = $this->department;
    if($this->syllabus_link) return $this->syllabus_link;
    $map = config('tripura.syllabus');
    return $map[$dept] ?? $map['default'] ?? null;
}
public function getAutoPyqAttribute(){
    if($this->pyq_link) return $this->pyq_link;
    $map = config('tripura.pyq');
    return $map[$this->department] ?? $map['default'] ?? null;
}
}