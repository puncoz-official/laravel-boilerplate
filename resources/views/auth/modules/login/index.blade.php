@extends('auth.layouts.main')

@section('title', __('Login'))

@section('content')
	<div class="card">
		
		<div class="card-header">{{ __('Login') }}</div>
		
		<div class="card-body">
			<form action="" method="POST">
				@csrf
				
				<div class="form-group row">
					<label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('Email Address') }}</label>
				</div>
			</form>
		</div>
	
	</div>
@endsection
