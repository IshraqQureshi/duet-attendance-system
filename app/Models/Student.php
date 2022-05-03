<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'roll_no', 'section', 'batch_id'];

    public function batch(){
        return $this->belongsTo( Batch::class, 'batch_id', 'id');
    }
}
