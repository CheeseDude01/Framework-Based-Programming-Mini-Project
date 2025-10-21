<x-layouts.app :title="__('Dashboard')">
    <div class="p-6 space-y-4">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4"></h1>
        @livewire('manga-list')
    </div>
</x-layouts.app>
