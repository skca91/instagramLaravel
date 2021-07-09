<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Image') }}
        </h2>
    </x-slot>

    <div class="py-12">
           
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">


					<form method="POST" action="{{ route('image.update') }}" enctype="multipart/form-data">
						@csrf

						<input type="hidden" name="image_id" value="{{$image->id}}" />

						<div class="form-group row">
							<label for="image_path" class="col-md-3 col-form-label text-md-right">Image</label>
							<div class="col-md-7">
								@if($image->user->image)
								<div class="container-avatar">
									<img src="{{ route('image.file',['filename' => $image->image_path]) }}" class="avatar"/>									
								</div>
								@endif
								<input id="image_path" type="file" name="image_path" class="form-control {{ $errors->has('image_path') ? 'is-invalid' : '' }}" />

								@if($errors->has('image_path'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('image_path') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group row">
							<label for="description" class="col-md-3 col-form-label text-md-right">Description</label>
							<div class="col-md-7">
								<textarea id="description" name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" required>{{$image->description}}</textarea>

								@if($errors->has('description'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('description') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group row">

							<div class="col-md-6 offset-md-3">
								<input type="submit" class="btn btn-primary" value="Update">
							</div>
						</div>


					</form>

        </div>
    </div>
    </div>
</x-app-layout>