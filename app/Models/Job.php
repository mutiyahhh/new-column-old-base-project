<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $lable = 'jobs';
    protected $fillable = ['tugas', 'detail_tugas', 'type', 'level_id', 'file_laporan', 'image', 'cabang_id', 'created_by', 'status_approval'];

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'cabang_id');
    }

    public function relatedJobs()
    {
        return $this->belongsToMany(Job::class, 'related_jobs', 'job_id', 'related_job_id')
            ->withPivot('related_level_id')
            ->withTimestamps();
    }
}
