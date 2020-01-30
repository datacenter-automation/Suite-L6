@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ __('Locked') }}</div>
          <div class="card-body">
            <form method="POST" action="{{ route('login.unlock') }}" aria-label="{{ __('Locked') }}">
              @csrf
              <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                <div class="col-md-6">
                  <input id="password" type="password"
                         class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                         required>

                  @if ($errors->any())
                    <div class="mt-2 alert alert-danger p-0">
                      <ul style="display: inline-block">
                        @foreach ($errors->all() as $error)
                          <li style="font-size: 10pt; list-style-type: none" class="pt-2"><i class="fa fa-key fa-fw pr-4" aria-hidden="true"></i>{{ $error }}</li>
                        @endforeach
                      </ul>
                    </div>
                  @endif
                </div>
              </div>
              <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    {{ __('Unlock') }}
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
