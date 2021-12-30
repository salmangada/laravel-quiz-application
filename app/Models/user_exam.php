<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_exam extends Model
{
    use HasFactory;

    protected $table="user_exams";
    protected $primaryKey="id";

    protected $fillable=['user_id','exam_id','std_status','exam_joined'];
}
