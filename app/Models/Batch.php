<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    public function department(){
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function semester(){
        return $this->belongsTo(Semester::class, 'current_semester', 'id');
    }
    
}
