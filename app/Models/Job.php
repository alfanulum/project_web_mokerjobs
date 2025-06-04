<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function jobfair()
    {
        return $this->belongsTo(JobfairEvent::class);
    }

    protected $fillable = [
        'title',
        'company_id',
        'jobfair_event_id',
        'location',
        'description',
        'requirements',
        'education_level',
        'experience_years',
        'salary',
        'type',
        'posted_at',
        'expired_at',
        'apply_link',
    ];
}
