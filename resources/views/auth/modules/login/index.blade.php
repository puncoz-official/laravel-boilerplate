@extends('auth.layouts.app')

@section('title', 'Login')

@section('content')
    <div class="card-header">{{ __('Login') }}</div>
    
    <div class="card-body">
        @if($errors->has('login-failed'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('login-failed') }}
            </div>
        @endif
        
        {!! Form::open([
            'route' => 'auth.login.post',
            'method' => 'post',
            'id' => 'login-form',
            'role' => 'form'
        ]) !!}
        
        <div class="form-group row">
            {!! Form::label('username', 'Username / Email', [
                'class' => 'col-md-4 col-form-label text-md-right'
            ]) !!}
            
            <div class="col-md-6">
                {!! Form::text('username', null, [
                    'class' => 'form-control'.($errors->has('username') ? ' is-invalid' : ''),
                    'placeholder' => 'your username or email',
                    'autofocus' => true
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
                'class' => 'col-md-4 col-form-label text-md-right'
            ]) !!}
            
            <div class="col-md-6">
                {!! Form::password('password', [
                    'class' => 'form-control'.($errors->has('password') ? ' is-invalid' : ''),
                    'placeholder' => 'your password'
                ]) !!}
                
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        
        <div class="form-group row">
            <div class="col-md-6 offset-md-4">
                <div class="form-check">
                    {!! Form::checkbox('remember', true, null, [
                        'class' => 'form-check-input',
                        'id' => 'remember',
                    ]) !!}
                    
                    {!! Form::label('remember', 'Remember me', [
                        'class' => 'form-check-label'
                    ]) !!}
                </div>
            </div>
        </div>
        
        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                {!! Form::submit('Login', [
                    'class' => 'btn btn-primary'
                ]) !!}
                
                <a class="btn btn-link" href="{{ route('auth.password.forget') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            </div>
        </div>
        
        {!! Form::close() !!}
    </div>
@endsection
