<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewJobs extends Model
{
    use HasFactory;

     protected $guarded = ['id'];

    public function Job(){
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function User(){
        return $this->belongsTo(User::class, 'user_id');
    }

}
