@extends('auth.layouts.app')

@section('title', 'Register')

@section('content')
    <div class="card-header">{{ __('Register') }}</div>

    <div class="card-body">
        {!! Form::open([
            'route' => 'auth.register.post',
            'method' => 'post',
            'id' => 'login-form',
            'role' => 'form'
        ]) !!}

        <div class="form-group row">
            {!! Form::label('first_name', 'Name', [
                'class' => 'col-md-2 col-form-label text-md-right'
            ]) !!}

            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-6">
                        {!! Form::text('first_name', null, [
							'class' => 'form-control '.($errors->has('first_name') ? ' is-invalid' : ''),
							'placeholder' => 'first name',
							'autofocus' => true
						]) !!}

                        @if ($errors->has('first_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-md-6">
                        {!! Form::text('last_name', null, [
							'class' => 'form-control'.($errors->has('last_name') ? ' is-invalid' : ''),
							'placeholder' => 'last name'
						]) !!}

                        @if ($errors->has('last_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group row">
            {!! Form::label('email', 'Email', [
                'class' => 'col-md-2 col-form-label text-md-right'
            ]) !!}

            <div class="col-md-10">
                {!! Form::email('email', null, [
                    'class' => 'form-control'.($errors->has('email') ? ' is-invalid' : ''),
                    'placeholder' => 'your email address'
                ]) !!}

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            {!! Form::label('username', 'Username', [
                'class' => 'col-md-2 col-form-label text-md-right'
            ]) !!}

            <div class="col-md-10">
                {!! Form::text('username', null, [
                    'class' => 'form-control'.($errors->has('username') ? ' is-invalid' : ''),
                    'placeholder' => 'your username'
                ]) !!}

                @if ($errors->has('username'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            {!! Form::label('password', 'Password', [
                'class' => 'col-md-2 col-form-label text-md-right'
            ]) !!}

            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-6">
                        {!! Form::password('password', [
							'class' => 'form-control '.($errors->has('password') ? ' is-invalid' : ''),
							'placeholder' => 'new password',
							'autofocus' => true
						]) !!}

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-md-6">
                        {!! Form::password('password_confirmation', [
                            'class' => 'form-control'.($errors->has('password_confirmation') ? ' is-invalid' : ''),
                            'placeholder' => 'retype new password'
                        ]) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-2">
                {!! Form::submit('Register', [
                    'class' => 'btn btn-primary'
                ]) !!}

                <a class="btn btn-link" href="{{ route('auth.login') }}">
                    Already have account?
                </a>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
@endsection
