@extends('layouts.default')

@section('content')
		{{-- Display Status Message If Any --}}
		@if(session('status'))
			<div class="alert alert-success">
				{{ session('status') }}
			</div>
		@endif

		{{-- Upload Image Card --}}
		<div class="card">
			{{-- Heading --}}
			<div class="card-header text-center font-weight-bold">
				<h2>Upload Image & Extract Colors</h2>
			</div>

			{{-- Upload Image Form --}}
			<div class="card-body">
				<form method="POST" enctype="multipart/form-data" action="{{ route('image.save') }}" >
					@csrf
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								{{-- Input to Select Image --}}
								<input type="file" name="image" placeholder="Choose image" accept="image/*">
								{{-- Display Error If Any --}}
								@error('image')
									<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
								@enderror
							</div>
						</div>
						
						<div class="col-md-12">
							{{-- Submit Button --}}
							<button type="submit" class="btn btn-primary">Submit</button>

							{{-- Extract Colors Button --}}
							@if(session('id'))
								<a href="{{ route('image.extract-colors', session('id')) }}" type="button" class="btn btn-success ml-2">Extract Colors</a>
							@endif
						</div>
					</div>     
				</form>
			</div>
		</div>
@endsection