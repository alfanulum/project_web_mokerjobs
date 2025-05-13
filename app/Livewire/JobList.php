<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class JobList extends Component
{
    use WithPagination;

    public $perPage = 3;

    protected $paginationTheme = 'tailwind'; // agar pagination tailwind-compatible

    public function render()
    {
        $jobs = collect(config('jobs')) // Ambil dari config atau array dummy
            ->paginate($this->perPage);

        return view('livewire.job-list', [
            'jobs' => $jobs,
        ]);
    }
}
