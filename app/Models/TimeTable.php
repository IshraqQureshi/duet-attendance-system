<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeTable extends Model
{
    use HasFactory;

    public function subject(){
        return $this->belongsTo( Subject::class, 'subject_id', 'id');
    }

    public function department(){
        return $this->belongsTo( Department::class, 'department_id', 'id');
    }

    public function batch(){
        return $this->belongsTo( Department::class, 'batch_id', 'id');
    }
}
