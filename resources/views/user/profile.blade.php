<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
			
			<div class="profile-user">
			
				@if($user->image)
					<div class="container-avatar">
						<img src="{{ route('user.avatar',['filename'=>$user->image]) }}" class="avatar" />
					</div>
				@endif
				
				<div class="user-info">
					<h1>{{'@'.$user->nick}}</h1>
					<h2>{{$user->name .' '. $user->lastname}}</h2>
				</div>
				
				<div class="clearfix"></div>
				<hr>
			</div>
			
			<div class="clearfix"></div>
			
        </div>

    </div>
</div>
</x-app-layout>

