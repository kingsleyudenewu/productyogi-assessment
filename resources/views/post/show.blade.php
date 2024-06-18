<x-app-layout>


    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-3 lg:px-5">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <livewire:show-post :post="$post" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
