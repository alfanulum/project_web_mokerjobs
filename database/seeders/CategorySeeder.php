<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'Admin & Operations', 'icon' => 'fa-briefcase'],
            ['name' => 'Business Dev & Sales', 'icon' => 'fa-chart-line'],
            ['name' => 'CS & Hospitality', 'icon' => 'fa-headset'],
            ['name' => 'Data & Product', 'icon' => 'fa-database'],
            ['name' => 'Design & Creative', 'icon' => 'fa-paint-brush'],
            ['name' => 'Education & Training', 'icon' => 'fa-book-open'],
            ['name' => 'Finance & Accounting', 'icon' => 'fa-calculator'],
            ['name' => 'Food & Beverage', 'icon' => 'fa-utensils'],
            ['name' => 'HR & Recruiting', 'icon' => 'fa-user-friends'],
            ['name' => 'IT & Engineering', 'icon' => 'fa-code'],
        ];

        foreach ($data as $category) {
            Category::create($category);
        }
    }
}
