@extends('auth.layouts.main')

@section('title', 'Login')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
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
			</div>
		</div>
	</div>
@endsection
