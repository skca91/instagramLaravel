<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload Image') }}
        </h2>
    </x-slot>

    <div class="py-12">
           
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <form method="POST" action="{{ route('user.update') }}" enctype="multipart/form-data">
                        @csrf

                         <!-- Image -->
                         <div class="mt-4">
                         @if(Auth::user()->image)
                            <img src="{{ route('user.avatar', ['filename' => Auth::user()->image]) }}" class="avatar" />
                         @endif

                         </div>

                         <div class="mt-4">
                         <x-label for="image_path" :value="__('Image')" />
                            <x-input id="image_path" class="block mt-1 w-full" type="file" name="image_path" required />
                            @if($errors->has('image_path'))
                                <span role="alert">
                                    <strong>{{ $errors->first('image_path') }}</strong>
                                </span>
                             @endif
                        </div>

                        <!-- Description -->
                        <div>
                            <x-label for="description" :value="__('Description')" />

                            <x-input id="description" class="block mt-1 w-full" type="text" name="description" required autofocus />
                            @if($errors->has('description'))
                                <span role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        
                        </div>

                        <div class="flex items-center justify-end mt-4">

                            <x-button class="ml-4">
                                {{ __('Upload') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

