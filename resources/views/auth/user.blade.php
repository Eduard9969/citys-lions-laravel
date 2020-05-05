@extends('layouts.app')

@section('content')
    <div class="container justify-content-center">
        <div class="row">
            <div class="col-3 card align-items-center p-3">
                <div class="avatar position-relative overflow-hidden rounded-circle bg-light text-center" style="width: 150px;height:150px;">
                    <a href="{{ route('user.settings.avatar') }}"
                       title="{{ $user['first_name'] . ' ' . $user['last_name'] }}"
                       class="position-absolute"
                       style="left: 50%;top:50%;transform: translate(-50%, -50%);">
                        {{ __('Choose avatar') }}
                    </a>
                </div>
            </div>
            <div class="col-9 card">
                <div class="card-body">
                    <table>
                        <tbody>
                            <tr>
                                <td>{{ __('First Name') }}:</td>
                                <td class="pl-3">{{ $user['first_name'] }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Last Name') }}:</td>
                                <td class="pl-3">{{ $user['last_name'] }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Email') }}:</td>
                                <td class="pl-3">{{ $user['email'] }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Register at') }}:</td>
                                <td class="pl-3">{{ date('Y-m-d H:i', strtotime($user['created_at'])) }}</td>
                            </tr>
                        </tbody>
                    </table>

                    @if($user['id'] == $user_id)
                        <div class="btn-group-sm mt-3">
                            <a href="{{ route('user.settings') }}" class="btn btn-success btn-sm">{{ __('Edit Information') }}</a>
                            <a href="{{ route('user.settings.avatar') }}" class="btn btn-info btn-sm text-white">{{ __('Edit Avatar') }}</a>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm">{{ __('Admin Area') }}</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="card col-12">
                <div class="card-body">
                    ...
                </div>
            </div>
        </div>
    </div>
@endsection
