@extends('layouts.default')

@section('content')
		{{-- Display Status Message If Any --}}
		@if($status)
			<div class="alert alert-success">
				{{ $status }}
			</div>
		@endif

		{{-- Display Original Image uploaded by User --}}
		@if($originalImage)
			<div class="card">
				<div class="card-header text-center font-weight-bold">
					<h3>Original Image</h3>
				</div>

				<div class="card-body">
					<img class="image" src="{{ asset("storage/images/".$originalImage) }}">
				</div>
			</div>
		@endif

		{{-- Display Cropped Image --}}
		@if($croppedImage)
			<div class="card">
				<div class="card-header text-center font-weight-bold">
					<h3>Cropped Image</h3>
				</div>

				<div class="card-body">
					<img class="image" src="{{ asset("storage/images/".$croppedImage) }}">
				</div>
			</div>
		@endif
 
		{{-- Show extracted colors --}}
 		@if($colors)
			<div class="card">
				<div class="card-header text-center font-weight-bold">
					<h3>Colors Extracted from Cropped Image</h3>
				</div>

				<div class="card-body">
						<div class="row">

					@foreach ($colors as $color)
							<div class="col-2">
								<p class="mb-n3 ml-1"><strong>{{ $color }}</strong><p>
								<div class="pixel-box" style="background:{{ $color }}"></div>
							</div>
					@endforeach
						</div>

				</div>
			</div>
		@endif

		{{-- Back Button --}}
		<div class="pull-right my-3">
                <a class="btn btn-primary" href="{{ url()->previous() }}" title="Go back"> Back </a>
		</div>
@endsection

<style>
.pixel-box {
  float: left;
  width: 100px;
  height: 50px;
  margin: 5px;
  border: 1px solid rgba(0, 0, 0, .2);
}
.image {
	display: block;
	margin-left: auto;
	margin-right: auto;
	max-width: 90%;
	border: 1px solid;
}
</style>