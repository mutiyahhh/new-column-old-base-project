<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    use HasFactory;

    protected $lable = 'cabangs';
    protected $fillable = ['cabang'];

    public function User()
    {
        return $this->hasMany(User::class, 'cabang_id', 'id');

    }
    public function Job()
    {
        return $this->hasMany(Job::class, 'cabang_id', 'id');

    }


}
