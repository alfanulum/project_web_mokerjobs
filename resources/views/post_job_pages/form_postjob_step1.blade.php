@extends('layouts.app')

@section('content')
<div class="flex flex-col lg:flex-row min-h-screen">
  <!-- Left: Form Inputs -->
  <div class="w-full lg:w-1/2 bg-white p-8">
    <h2 class="text-2xl font-bold mb-4">Job Name</h2>
    <p class="text-gray-600 mb-2">Enter the name of the job or position to be posted.</p>
    <input type="text" name="job_name" class="w-full border border-orange-500 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-orange-500 mb-8">

    <h2 class="text-2xl font-bold mb-4">Job Type</h2>
    <p class="text-gray-600 mb-2">Enter the type of the job or position to be posted.</p>

    @include('components.filter_dropdown', [
    'title' => 'Job Type',
    'name' => 'job_type',
    'options' => $jobTypes
    ])
  </div>

  <!-- Right: Category Selection -->
  <div class="w-full lg:w-1/2 bg-orange-500 text-white p-8">
    <h2 class="text-2xl font-bold mb-2">Category</h2>
    <p class="text-white mb-6">Enter the category of the job or position to be posted.</p>
    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mb-8">
      @php
      $categories = [
      'Admin & Operations', 'Business Dev & Sales', 'CS & Hospitality', 'Data & Product',
      'Design & Creative', 'Education & Training', 'Finance & Accounting', 'Food & Beverage',
      'HR & Recruiting', 'Health & Science', 'IT & Engineering', 'Marketing & Socmed',
      'Home Service', 'Technical Work', 'Retail & Merchandising', 'Transportation & Logistic'
      ];
      @endphp
      @foreach($categories as $category)
      <button type="button" class="bg-white text-orange-600 px-4 py-2 rounded-lg font-medium hover:bg-orange-100">
        {{ $category }}
      </button>
      @endforeach
    </div>

    <div class="text-right">
      <button type="submit" class="bg-yellow-400 text-black px-6 py-3 rounded-full font-semibold hover:bg-yellow-300">
        Next
      </button>
    </div>
  </div>
</div>
@endsection