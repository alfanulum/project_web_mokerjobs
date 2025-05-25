<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    use HasFactory;

    protected $table = 'lowongan';

    protected $guarded = []; // atau daftar field jika kamu ingin lebih spesifik
    protected $fillable = [
        'job_name',
        'job_type',
        'category_job',
        'place_work',
        'type_gender',
        'education_minimal',
        'experience_min',
        'age',
        'location',
        'job_description',
        'job_requirements',
        'salary_minimal_range',
        'maximum_salary_range',
        'company_name',
        'company_description',
        'company_address',
        'company_industry',
        'company_website',
        'company_logo_image',
        'email_company',
        'no_wa_company',
        'social_media_company',
        'deadline'
    ];
}
