@extends('admin.base')

@section('content')
    <div class="w-100 h-100 flex justify-center items-center pt6-ns pt4">
        <form action="{{ route('password.request') }}"
              method="POST"
              class="mw6 w-90 col-w-bg pa4">
            <svg fill="#dddddd"
                 height="60"
                 viewBox="0 0 24 24"
                 width="60"
                 class="db center"
                 xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink">
                <defs>
                    <path d="M0 0h24v24H0V0z"
                          id="a"/>
                </defs>
                <clipPath id="b">
                    <use overflow="visible"
                         xlink:href="#a"/>
                </clipPath>
                <path clip-path="url(#b)"
                      d="M12 17c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm6-9h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM8.9 6c0-1.71 1.39-3.1 3.1-3.1s3.1 1.39 3.1 3.1v2H8.9V6zM18 20H6V10h12v10z"/>
            </svg>
            <h1 class="col-grey tc">Reset Your Password</h1>
            {!! csrf_field() !!}
            <input type="hidden"
                   name="token"
                   value="{{ $token }}">
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} mv3">
                <label class="col-p f6 ttu"
                       for="email">Email: </label>
                @if($errors->has('email'))
                    <span class="error-message">{{ $errors->first('email') }}</span>
                @endif
                <input type="text"
                       name="email"
                       value="{{ $email ?? old('email') }}"
                       class="h2 pl2 input w-100">
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} mv3">
                <label class="col-p f6 ttu"
                       for="password">New Password: </label>
                @if($errors->has('password'))
                    <span class="error-message">{{ $errors->first('password') }}</span>
                @endif
                <input type="text"
                       name="password"
                       value="{{ old('password') }}"
                       class="h2 pl2 input w-100">
            </div>
            <div class="form-group mv3">
                <label class="col-p f6 ttu"
                       for="password_confirmation">Confirm Password: </label>
                @if($errors->has('password_confirmation'))
                    <span class="error-message">{{ $errors->first('password_confirmation') }}</span>
                @endif
                <input type="text"
                       name="password_confirmation"
                       value="{{ old('password_confirmation') }}"
                       class="h2 pl2 input w-100">
            </div>
            <div class="flex justify-end items-center mv4">
                <button type="submit"
                        class="col-bg-trans pv2 ph3 bn outline col-p">Reset Password
                </button>
            </div>
        </form>
    </div>
@endsection