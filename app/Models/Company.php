<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function jobfairs()
    {
        return $this->belongsToMany(JobfairEvent::class, 'jobfair_company');
    }

    protected $fillable = [
        'name',
        'slug',
        'industry',
        'location',
        'website',
        'email',
        'whatsapp',
        'description',
        'logo_path'
    ];
}
