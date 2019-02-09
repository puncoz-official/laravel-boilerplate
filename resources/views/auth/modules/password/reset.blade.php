@extends('auth.layouts.app')

@section('title', 'Reset Password')

@section('content')
    <div class="card-header">{{ __('Reset Password') }}</div>
    
    <div class="card-body">
        @include('flash::message')
        
        {!! Form::open([
            'route' => 'auth.password.reset.post',
            'method' => 'post',
            'id' => 'login-form',
            'role' => 'form'
        ]) !!}
        
        {!! Form::hidden('token', $token) !!}
        
        <div class="form-group row">
            {!! Form::label('email', 'Email Address', [
                'class' => 'col-md-4 col-form-label text-md-right'
            ]) !!}
            
            <div class="col-md-6">
                {!! Form::email('email', $email, [
                    'class' => 'form-control'.($errors->has('email') ? ' is-invalid' : ''),
                    'placeholder' => 'your email',
                    'autofocus' => true
                ]) !!}
                
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        
        <div class="form-group row">
            {!! Form::label('password', 'Password', [
                'class' => 'col-md-4 col-form-label text-md-right'
            ]) !!}
            
            <div class="col-md-6">
                {!! Form::password('password', [
                    'class' => 'form-control'.($errors->has('password') ? ' is-invalid' : ''),
                    'placeholder' => 'new password'
                ]) !!}
                
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        
        <div class="form-group row">
            {!! Form::label('password_confirmation', 'Confirm Password', [
                'class' => 'col-md-4 col-form-label text-md-right'
            ]) !!}
            
            <div class="col-md-6">
                {!! Form::password('password_confirmation', [
                    'class' => 'form-control'.($errors->has('password_confirmation') ? ' is-invalid' : ''),
                    'placeholder' => 'retype new password'
                ]) !!}
                
                @if ($errors->has('password_confirmation'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        
        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                {!! Form::submit('Reset Password', [
                    'class' => 'btn btn-primary'
                ]) !!}
                
                <a class="btn btn-link" href="{{ route('auth.login') }}">Back to login</a>
            </div>
        </div>
        
        {!! Form::close() !!}
    </div>
@endsection
