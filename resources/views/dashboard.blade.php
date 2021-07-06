<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
				<div class="card-header">
            @if(session('message'))
                    <div class='alert alert-success'>
                        {{ session('message') }}
                    </div>
            @endif

            @foreach($images as $image)

            @if($image->user->image)
            <div class="container-avatar">
                <img src="{{ route('user.avatar',['filename'=>Auth::user()->image]) }}" class="avatar" />
            </div>
		@endif

		<div class="data-user">
                
                    {{$image->user->name.' '.$image->user->surname}}
                    <span class="nickname">
                        {{' | @'.$image->user->nick}}
                    </span>
                
            </div>
        </div>

        <div class="card-body">
            <div class="image-container">
                <img src="{{ route('image.file',['filename' => $image->image_path]) }}" />
            </div>

            <div class="description">
                <span class="nickname">{{'@'.$image->user->nick}} </span>
                
                <p>{{$image->description}}</p>
            </div>

            <div class="likes">

                <!-- Comprobar si el usuario le dio like a la imagen -->
                <?php $user_like = false; ?>
                @foreach($image->likes as $like)
                @if($like->user->id == Auth::user()->id)
                <?php $user_like = true; ?>
                @endif
                @endforeach

                @if($user_like)
                <img src="{{asset('img/heartred.png')}}" data-id="{{$image->id}}" class="btn-dislike"/>
                @else
                <img src="{{asset('img/heartgris.png')}}" data-id="{{$image->id}}" class="btn-like"/>
                @endif

                <span class="number_likes">{{count($image->likes)}}</span>
            </div>

            <div class="comments">
            <a href="{{ route('image.detail', ['id' => $image->id])}}" class="btn btn-sm btn-warning btn-comments">
				Comentarios ({{count($image->comments)}})
			</a>
            </div>
            @endforeach
            </div>
            {{ $images->links() }}
        </div>
    </div>
</x-app-layout>
