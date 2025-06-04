<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobfairEvent;
use App\Models\Company;
use App\Models\Job;
use Illuminate\Support\Str;

class JobfairSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat event jobfair
        $event = JobfairEvent::create([
            'name' => 'Jobfair Surabaya 2025',
            'slug' => Str::slug('Jobfair Surabaya 2025'),
            'date_start' => '2025-06-10',
            'date_end' => '2025-06-12',
            'location' => 'Surabaya Convention Center',
            'description' => 'Jobfair terbesar di Surabaya tahun 2025',
        ]);

        // 2. Buat perusahaan
        $company = Company::create([
            'name' => 'PT Maju Jaya',
            'slug' => Str::slug('PT Maju Jaya'),
            'industry' => 'Teknologi Informasi',
            'location' => 'Jakarta',
            'website' => 'https://pt-majujaya.com',
            'description' => 'Perusahaan software house.',
        ]);

        // 3. Hubungkan perusahaan ke event
        $event->companies()->attach($company->id);

        // 4. Tambahkan lowongan
        Job::create([
            'title' => 'Backend Developer',
            'company_id' => $company->id,
            'jobfair_event_id' => $event->id,
            'location' => 'Remote',
            'description' => 'Membangun API Laravel.',
            'requirements' => 'Laravel, PostgreSQL.',
            'education_level' => 'S1 Teknik Informatika',
            'experience_years' => 1,
            'salary' => 'Rp 7.000.000 - Rp 10.000.000',
            'type' => 'fulltime',
            'posted_at' => now(),
            'expired_at' => now()->addMonth(),
            'apply_link' => 'https://forms.gle/contoh-google-form', // Link dari admin
        ]);
    }
}
