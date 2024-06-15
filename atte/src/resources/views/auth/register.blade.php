@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endsection

@section('content')
<div class="register__content">
  <h2 class="register-form__heading">
    会員登録
  </h2>
  <div class="register-form__group">
    <form class="form" action="/register" method="post">
      @csrf
      <div class="register-form-input">
        <div class="register-form__input--text">
          <input class="register-form__input--zone" type="text" name="name" value="{{ old('name') }}" placeholder="お名前">
        </div>
        <div class="form__error">
          @error('email')
          {{ $message }}
          @enderror
        </div>
      </div>
      <div class="register-form-input">
        <div class="register-form__input--text">
          <input class="register-form__input--zone" type="email" name="email" value="{{ old('email') }}" placeholder="メールアドレス">
        </div>
        <div class="form__error">
          @error('email')
          {{ $message }}
          @enderror
        </div>
      </div>
      <div class="register-form-input">
        <div class="register-form__input--text">
          <input class="register-form__input--zone" type="password" class="form__input--zone" name="password" placeholder="パスワード">
        </div>
        <div class="form__error">
          @error('password')
          {{ $message }}
          @enderror
        </div>
      </div>
      <div class="register-form-input">
        <div class="register-form__input--text">
          <input class="register-form__input--zone" type="password" class="form__input--zone" name="password_confirmation" placeholder="確認用パスワード">
        </div>
        <div class="form__error">
          @error('password')
          {{ $message }}
          @enderror
        </div>
      </div>
      <div class="register-form__button">
        <button class="register-form__button-submit" type="submit">
        会員登録
        </button>
      </div>
    </form>
    <div class="login__link">
      <p class="login__label">
      アカウントをお持ちの方はこちらから
      </p>
      <a class="login__button-submit" href="/login">
      ログイン
      </a>
    </div>
  </div>
</div>
@endsection

