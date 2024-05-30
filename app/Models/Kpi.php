<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kpi extends Model
{
    use HasFactory;

    protected $lable = 'kpis';
    protected $fillable = ['name_kpi','p_measure','level_id'];


    public function Level()
    {
        return $this->belongsTo(Level::class, 'level_id', 'id');
    }

}
