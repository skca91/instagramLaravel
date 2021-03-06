<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
           
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            @if(session('message'))
                    <div class='alert alert-success'>
                        {{ session('message') }}
                    </div>
            @endif
                <div class="p-6 bg-white border-b border-gray-200">

               
                 <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('user.update') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-label for="name" :value="__('Name')" />

                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ Auth::user()->name }}" required autofocus />
                        </div>

                        <!-- Lastname -->
                        <div>
                            <x-label for="lastname" :value="__('Lastname')" />

                            <x-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" value="{{ Auth::user()->lastname }}" required autofocus />
                        </div>

                        <!-- Nick -->
                        <div>
                            <x-label for="nick" :value="__('Nick')" />

                            <x-input id="nick" class="block mt-1 w-full" type="text" name="nick" value="{{ Auth::user()->nick }}" required autofocus />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-label for="email" :value="__('Email')" />

                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ Auth::user()->email }}" required />
                        </div>

                         <!-- Profile Photo -->
                         <div class="mt-4">
                         @if(Auth::user()->image)
                            <img src="{{ route('user.avatar', ['filename' => Auth::user()->image]) }}" class="avatar" />
                         @endif

                         </div>

                         <div class="mt-4">
                         <x-label for="image" :value="__('Avatar')" />
                            <x-input id="image" class="block mt-1 w-full" type="file" name="image" required />
                        </div>

                        <div class="flex items-center justify-end mt-4">

                            <x-button class="ml-4">
                                {{ __('Save') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

