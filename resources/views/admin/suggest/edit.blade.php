@extends('admin.layouts.app')

@section('content')
    <div class="container justify-content-center">
        <div class="row">
            <div class="col-12 col-md-8 order-2 mb-4">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.suggest.update', ['suggest' => $suggest['id']]) }}" >
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input required id="name" type="text" name="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           value="@if(!empty(old('name'))) {{ old('name') }} @elseif(isset($suggest['name'])){{ $suggest['name'] }} @endif">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <textarea required class="form-control @error('description') is-invalid @enderror"
                                              name="description" id="description" cols="30" rows="5"
                                              class="w-100">{{ !empty(old('description')) ? old('description') : (!empty($suggest['description']) ? $suggest['description'] : '') }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="features" class="col-md-4 col-form-label text-md-right">{{ __('Features') }}</label>

                                <div class="col-md-6">
                                    <textarea class="form-control @error('features') is-invalid @enderror"
                                              name="features" id="features" cols="30" rows="2"
                                              class="w-100">{{ !empty(old('features')) ? old('features') : (!empty($suggest['features']) ? $suggest['features'] : '') }}</textarea>
                                </div>
                            </div>

                            <input type="hidden" name="status_id" value="{{ $suggest['status_id'] }}">

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4 order-1 order-md-3 mb-4">
                <div class="justify-content-center align-items-center">
                    <a href="{{ route('user.profile', ['user' => $user['id']]) }}" class="d-block m-auto avatar position-relative overflow-hidden rounded-circle bg-light text-center" style="width: 150px;height:150px;">
                        <img @if(isset($user['avatar_alias']) && !empty($user['avatar_alias'])) src="{{ asset('images/user_pic/' . $user['id'] . '/' . $user['avatar_alias']) }}" @endif
                        class="position-absolute"
                             style="left: 50%;top:50%;transform: translate(-50%, -50%);width: 100%;min-height: 100%">
                    </a>

                    <div class="text-center mt-4">
                        <span class="d-block small text-muted text-uppercase">{{ __('Proposed') }}</span>
                        <a class="text-body d-block" href="{{ route('user.profile', ['user' => $user['id']]) }}">
                            <h5>{{ $user['first_name'] . ' ' . $user['last_name'] }}</h5>
                        </a>
                        <span class="d-block small text-black-50">
                            {{ __('Register At') }}: {{ date('Y-m-d H:i', strtotime($user['created_at'])) }}
                        </span>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
