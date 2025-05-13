<div
    x-data="{ show: false }"
    x-init="$nextTick(() => { show = true })"
    x-show="show"
    x-transition:enter="transition ease-out duration-500"
    x-transition:enter-start="opacity-0 translate-y-2"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 -translate-y-2"
    class="space-y-6">
    @foreach ($jobs as $job)
    @include('components.card_job', ['job' => $job])
    @endforeach

    <div class="mt-4">
        {{ $jobs->links('components.pagination') }}
    </div>
</div>