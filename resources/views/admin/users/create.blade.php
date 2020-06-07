@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card w-100">
                    <div class="card-header">{{ __(!empty($user) ? 'Edit' : 'Add new') }} {{ __('User') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ !empty($user) ? route('admin.users.update', ['user' => $user['id']]) : route('admin.users.store') }}" >
                            @csrf

                            @if(!empty($user))
                                @method('PUT')
                            @endif

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Login') }}</label>

                                <div class="col-md-6">
                                    <input id="login" type="text" {{ !empty($user) ? 'readonly' : 'name=login' }} class="form-control @error('login') is-invalid @enderror" value="@if(isset($user['login'])){{ $user['login'] }}@endif">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                                <div class="col-md-6">
                                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="@if(!empty(old('first_name'))){{ old('first_name') }} @elseif(isset($user['first_name'])) {{ $user['first_name']  }} @endif" required autocomplete="name" autofocus>

                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="@if(!empty(old('last_name'))){{ old('last_name') }} @elseif(isset($user['last_name'])) {{ $user['last_name']  }} @endif" required autocomplete="name" autofocus>

                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="@if(!empty(old('email'))){{ old('email') }} @elseif(isset($user['email'])) {{ $user['email']  }} @endif" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('User Role') }}</label>
                                <div class="col-md-6">
                                    <select required name="role_id" id="role" class="form-control custom-select @error('role_id') is-invalid @enderror">
                                        @if(isset($roles))
                                            @foreach($roles as $key => $role)
                                                <option {{ ( ((is_int(old('role_id')) && old('role_id') == $key) || (isset($user) && is_int($user['role']['id']) && $user['role']['id'] == $key)) ? 'selected' : '' ) }} value="{{ $key }}">{{ __(ucfirst($role)) }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('User Status') }}</label>
                                <div class="col-md-6">
                                    <select required name="status_id" id="status" class="form-control custom-select @error('status_id') is-invalid @enderror">
                                        <option value="-1">{{ __('User Status') }}</option>
                                        @if(isset($users_statuses))
                                            @foreach($users_statuses as $key => $status)
                                                <option {{ ( ((is_int(old('status_id')) && old('status_id') == $status) || (isset($user) && is_int($user['status_id']) && $user['status_id'] == $status)) ? 'selected' : '' ) }} value="{{ $status }}">{{ __(ucfirst($key)) }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ !empty($user) ? __('New Password') : __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ !empty($user) ? __('Confirm New Password') : __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                </div>
                            </div>

                            @if(!empty($user))
                                <div class="border-top mb-3"></div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Control avatar') }}</label>

                                    <div class="col-md-6">
                                        <a href="#"  class="btn btn-link px-0 text-danger" onclick="event.preventDefault();document.getElementById('delete-form-{{ $user['id'] }}').submit();">
                                            {{ __('Delete avatar') }}
                                        </a>
                                    </div>
                                </div>
                            @endif

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __( !empty($user) ? 'Update' : 'Add' ) }}
                                    </button>
                                </div>
                            </div>
                        </form>

                        @if(!empty($user))
                            <form id="delete-form-{{ $user['id'] }}" action="{{ route('user.settings.avatar.delete', ['user' => $user['id']]) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
