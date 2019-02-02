@extends('auth.layouts.app')

@section('title', 'Forget Password')

@section('content')
    <div class="card-header">Forget Password</div>
    
    <div class="card-body">
        @include('flash::message')
        
        {!! Form::open([
            'route' => 'auth.password.forget',
            'method' => 'post',
            'id' => 'login-form',
            'role' => 'form'
        ]) !!}
        
        <div class="form-group row">
            {!! Form::label('email', 'Email Address', [
                'class' => 'col-md-4 col-form-label text-md-right'
            ]) !!}
            
            <div class="col-md-6">
                {!! Form::email('email', null, [
                    'class' => 'form-control'.($errors->has('email') ? ' is-invalid' : ''),
                    'placeholder' => 'your registered email',
                    'autofocus' => true
                ]) !!}
                
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        
        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                {!! Form::submit('Send Password Reset Link', [
                    'class' => 'btn btn-primary'
                ]) !!}
                
                <a class="btn btn-link" href="{{ route('auth.login') }}">Back to login</a>
            </div>
        </div>
        
        {!! Form::close() !!}
    </div>
@endsection
