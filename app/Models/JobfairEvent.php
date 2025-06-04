<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobfairEvent extends Model
{
    public function companies()
    {
        return $this->belongsToMany(Company::class, 'jobfair_company');
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    protected $fillable = [
        'name',
        'slug',
        'date_start',
        'date_end',
        'location',
        'description',
    ];
    protected $casts = [
        'date_start' => 'date:Y-m-d', // Akan mengembalikan string YYYY-MM-DD saat diakses
        'date_end' => 'date:Y-m-d',   // Akan mengembalikan string YYYY-MM-DD saat diakses
    ];
}
