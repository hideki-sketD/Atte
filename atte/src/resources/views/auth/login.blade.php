@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

@section('content')
<div class="login__content">
  <h2 class="login-form__heading">
    ログイン
  </h2>
  <div class="login-form__group">
    <form class="form" action="/login" method="post">
      <div class="login-form-input">
        @csrf
        <div class="login-form__input--text">
          <input class="login-form__input--zone" type="email" name="email" value="{{ old('email') }}" placeholder="メールアドレス">
        </div>
        <div class="form__error">
          @error('email')
          {{ $message }}
          @enderror
        </div>
      </div>
      <div class="login-form-input">
        @csrf
        <div class="login-form__input--text">
          <input type="password" class="login-form__input--zone" name="password" placeholder="パスワード">
        </div>
        <div class="form__error">
          @error('password')
          {{ $message }}
          @enderror
        </div>
      </div>
      <div class="login-form__button">
        <button class="login-form__button-submit" type="submit">
        ログイン
        </button>
      </div>
    </form>
    <div class="register__link">
      <p class="register__label">
      アカウントをお持ちでない方はこちらから
      </p>
      <a class="register__button-submit" href="/register">
      会員登録
      </a>
    </div>
  </div>
</div>
@endsection