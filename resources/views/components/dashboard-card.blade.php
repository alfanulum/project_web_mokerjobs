<!-- resources/views/components/dashboard-card.blade.php -->
@props(['title', 'value', 'color' => 'blue'])

<div class="bg-white rounded-xl shadow p-4 border-l-4 border-{{ $color }}-500">
    <div class="text-gray-600 text-sm">{{ $title }}</div>
    <div class="text-2xl font-semibold text-{{ $color }}-600">{{ $value }}</div>
</div>