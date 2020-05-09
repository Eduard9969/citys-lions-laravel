@extends('layouts.app')

@section('content')
    <div class="container justify-content-center">
        <div class="row">
            <div class="col-3 card align-items-center p-3">
                <div class="avatar position-relative overflow-hidden rounded-circle bg-light text-center" style="width: 150px;height:150px;">
                    @if($user['id'] == \Illuminate\Support\Facades\Auth::id() && (!isset($user['avatar_alias']) || empty($user['avatar_alias'])))
                        <a href="{{ route('user.settings.avatar') }}"
                           title="{{ $user['first_name'] . ' ' . $user['last_name'] }}"
                           class="position-absolute"
                           style="left: 50%;top:50%;transform: translate(-50%, -50%);">
                            {{ __('Choose avatar') }}
                        </a>
                    @else
                        <img @if(isset($user['avatar_alias']) && !empty($user['avatar_alias'])) src="{{ asset('images/user_pic/' . $user['id'] . '/' . $user['avatar_alias']) }}" @endif
                             class="position-absolute"
                             style="left: 50%;top:50%;transform: translate(-50%, -50%);width: 100%;min-height: 100%">
                    @endif
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
                                <td>{{ __('Role') }}:</td>
                                <td class="pl-3">
                                    @if(!empty($user['roles']))
                                        @foreach($user['roles'] as $user_role)
                                            {{ $user_role['name'] }} @if($loop->index > 0), @endif
                                        @endforeach
                                    @endif
                                </td>
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
                            <a href="{{ route('user.settings') }}" class="btn btn-success btn-sm">
                                {{ __('Edit Information') }}
                            </a>
                            <a href="{{ route('user.settings.avatar') }}" class="btn btn-info btn-sm text-white">
                                {{ __('Edit Avatar') }}
                            </a>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm">
                                {{ __('Admin Area') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="card col-12 p-0">
                <div class="card-header">
                    <span>{{ __('Last User Comments') }}</span>
                </div>
                <div class="card-body px-2">
                    @if(!empty($comments))
                        <table class="table">
                            @foreach($comments as $comment)
                                <tr>
                                    <td @if($loop->first) class="border-top-0" @endif>
                                        <a class="text-body" href="{{ route('places.show', ['place' => $comment['place_id']]) }}">
                                            {{ \Illuminate\Support\Str::limit($comment['comment'], 150, $end='...') }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <span class="d-block text-center">
                            {{ __('No Data') }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
