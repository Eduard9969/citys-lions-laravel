@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card w-100">
                    <div class="card-header">{{ __('Settings Avatar') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('user.settings.avatar.post') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <div class="m-auto">
                                    <div class="row">
                                        <div class="col-12 card align-items-center p-3">
                                            <div class="avatar position-relative overflow-hidden rounded-circle bg-light text-center" style="width: 150px;height:150px;">
                                                <img
                                                   @if(!empty($user['avatar_alias'])) src="{{ asset('images/user_pic/' . $user_id . '/' . $user['avatar_alias']) }}" @endif
                                                   id="blah"
                                                   class="position-absolute"
                                                   style="left: 50%;top:50%;transform: translate(-50%, -50%);width: 100%;min-height: 100%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="avatar" class="col-md-4 col-form-label text-md-right">{{ __('Avatar') }}</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="avatar" class="custom-file-input" id="avatar" required>
                                            <label class="custom-file-label" for="avatar">{{ __('Choose Avatar') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Edit Avatar') }}
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
