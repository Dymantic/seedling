@extends('admin.base')

@section('content')
    <div class="w-100 h-100 flex justify-center items-center pt6-ns pt4">
        <form action="{{ route('login') }}" method="POST" class="mw6 w-90 col-w-bg pa4">
            <svg fill="#ddd" height="60" viewBox="0 0 24 24" width="60" class="center db" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 11.75c-.69 0-1.25.56-1.25 1.25s.56 1.25 1.25 1.25 1.25-.56 1.25-1.25-.56-1.25-1.25-1.25zm6 0c-.69 0-1.25.56-1.25 1.25s.56 1.25 1.25 1.25 1.25-.56 1.25-1.25-.56-1.25-1.25-1.25zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8 0-.29.02-.58.05-.86 2.36-1.05 4.23-2.98 5.21-5.37C11.07 8.33 14.05 10 17.42 10c.78 0 1.53-.09 2.25-.26.21.71.33 1.47.33 2.26 0 4.41-3.59 8-8 8z"/>
                <path d="M0 0h24v24H0z" fill="none"/>
            </svg>
            <h1 class="col-grey tc">Login</h1>
            {!! csrf_field() !!}
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} mv3">
                <label class="col-p f6 ttu" for="email">Email: </label>
                @if($errors->has('email'))
                    <span class="error-message">{{ $errors->first('email') }}</span>
                @endif
                <input type="text" name="email" value="{{ old('email') }}" class="h2 pl2 input w-100" required autofocus>
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} mv3">
                <label class="col-p f6 ttu" for="password">Password: </label>
                @if($errors->has('password'))
                    <span class="error-message">{{ $errors->first('password') }}</span>
                @endif
                <input type="password" name="password" value="{{ old('password') }}" class="h2 pl2 input w-100">
            </div>
            <div class="mv3">
                <label class="col-p f6 ttu" for="remember">Remember me: </label>
                <input type="checkbox" id="remember" name="remember">
            </div>
            <div class="flex justify-between items-center mv4 pt4 bt b--black-10">
                <button type="submit" class="btn">Login</button>
                <request-password url="{{ route('password.email') }}" button-text=" forgot password"></request-password>
            </div>
        </form>
    </div>
@endsection