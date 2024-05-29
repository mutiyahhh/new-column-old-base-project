<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatedJobs extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function level()
    {
        return $this->belongsTo(Level::class, 'related_level_id');
    }

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function Relate()
    {
        return $this->hasMany(Job::class, 'relate_id', 'id');
    }
}