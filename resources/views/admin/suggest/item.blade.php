@extends('admin.layouts.app')

@section('content')
    <div class="container justify-content-center">
        <div class="row">
            <div class="col-12 col-md-8 order-2 mb-4">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="border-top-0" width="30%">{{ __('Name') }}</td>
                                    <td class="border-top-0" width="70%">{{ $suggest['name'] }}</td>
                                </tr>
                                <tr>
                                    <td width="30%">{{ __('Description') }}</td>
                                    <td class="text-break" width="70%">{{ $suggest['description'] }}</td>
                                </tr>
                                <tr>
                                    <td width="30%">{{ __('Features') }}</td>
                                    <td class="text-break" width="70%">{{ $suggest['features'] }}</td>
                                </tr>
                            </tbody>
                        </table>

                        @if(empty($suggest['status_id']))
                            <div class="text-center mt-3">
                                <form action="{{ route('admin.suggest.answer', ['suggest' => $suggest['id']]) }}" id="answer" method="POST">
                                    @csrf()

                                    <div class="btn-group">
                                        <label for="status_id_ok" class="btn btn-success">{{ __('Suggess') }}</label>
                                        <a style="margin-bottom: 0.5rem" href="{{ route('admin.suggest.edit', ['suggest' => $suggest['id']]) }}" class="btn btn-info text-white">{{ __('Edit') }}</a>
                                        <label for="status_id_no_ok" class="btn btn-danger">{{ __('Abort') }}</label>
                                    </div>

                                    <input class="d-none"
                                           onchange="document.querySelector('form#answer').submit()"
                                           id="status_id_ok" type="radio" name="status_id" value="1">

                                    <input class="d-none"
                                           onchange="document.querySelector('form#answer').submit()"
                                           id="status_id_no_ok" type="radio" name="status_id" value="2">
                                </form>
                            </div>
                        @endif
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
