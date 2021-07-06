<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            @if(session('message'))
                    <div class='alert alert-success'>
                        {{ session('message') }}
                    </div>
            @endif
            @foreach($images as $image)
                <div class="p-6 bg-white border-b border-gray-200">
                    {{ $image->user->name .' '. $image->user->lastname }}
                    <img src="{{ route('image.file', ['filename' => $image->image_path]) }}" />
                </div>
            @endforeach
            </div>
            {{ $images->links() }}
        </div>
    </div>
</x-app-layout>
