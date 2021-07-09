<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail') }}
        </h2>
    </x-slot>

	@if(session('message'))
                    <div class='alert alert-success'>
                        {{ session('message') }}
                    </div>
            @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="card pub_image pub_image_detail">
				<div class="card-header">

					@if($image->user->image)
					<div class="container-avatar">
						<img src="{{ route('user.avatar',['filename'=>$image->user->image]) }}" class="avatar" />
					</div>
					@endif

					<div class="data-user">
					<a href="{{ route('user.profile', ['id' => Auth::user()->id]) }}">
						{{$image->user->name.' '.$image->user->surname}}
								<span class="nickname">
									{{' | @'.$image->user->nick}}
								</span>
           			 </a> 
					</div>
				</div>

				<div class="card-body">
					<div class="image-container image-detail">
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

					@if(Auth::user() && Auth::user()->id == $image->user->id)
					<div class="actions">
						
						<!-- Button to Open the Modal -->
						<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal">
							Eliminar
						</button>

						<!-- The Modal -->
						<div class="modal" id="myModal">
							<div class="modal-dialog">
								<div class="modal-content">

									<!-- Modal Header -->
									<div class="modal-header">
										<h4 class="modal-title">¿Estas seguro?</h4>
										<button type="button" class="close" data-dismiss="modal">&times;</button>
									</div>

									<!-- Modal body -->
									<div class="modal-body">
										Si eliminar esta imagen nunca podrás recuperarla, ¿estas seguro de querer borrarla?
									</div>

									<!-- Modal footer -->
								

								</div>
							</div>
						</div>
					</div>
					@endif

					<div class="clearfix"></div>
					<div class="comments">

						<h2>Comentarios ({{count($image->comments)}})</h2>
						<hr>

						<form method="POST" action="{{ route('comment.save') }}">
							@csrf

							<input type="hidden" name="image_id" value="{{$image->id}}" />
							<p>
								<textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content"></textarea>
								@if($errors->has('content'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('content') }}</strong>
								</span>
								@endif
							</p>
							<button type="submit" class="btn btn-success">
								Enviar
							</button>
						</form>

						<hr>

						@foreach($image->comments as $comment)
						<div class="comment">

							<span class="nickname">{{'@'.$comment->user->nick}} </span>
							
							<p>{{$comment->content}}<br/>

								@if(Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))
								<a href="{{ route('comment.delete', ['id' => $comment->id]) }}" class="btn btn-sm btn-danger">
									Eliminar
								</a>
								@endif
							</p>
						</div>
						@endforeach

					</div>
				</div>
			</div>
        </div>
    </div>
</x-app-layout>
