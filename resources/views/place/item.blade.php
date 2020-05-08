@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card w-100">
                    @if(!empty($place_main_poster) || !empty($posters))

                        <div id="carouselSliderPosters" class="carousel slide"
                             style="max-height: 300px;overflow: hidden" data-ride="carousel">
                            <div class="carousel-inner">
                                @if(!empty($place_main_poster))
                                    <div class="carousel-item active">
                                        <img class="card-img-top d-block w-100"
                                             src="{{ asset('images/places/' . $place->id . '/' . $place_main_poster['alias']) }}"
                                             alt="{{ $place->name }}">
                                    </div>
                                @endif

                                @if(!empty($place_posters))
                                    @foreach($place_posters as $poster)
                                        <div class="carousel-item{{ ($loop->first && empty($place_main_poster)) ? ' active' : '' }}">
                                            <img class="card-img-top d-block w-100"
                                                 src="{{ asset('images/places/' . $place->id . '/' . $poster['alias']) }}"
                                                 alt="{{ $place->name }}">
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <a class="carousel-control-prev" href="#carouselSliderPosters" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselSliderPosters" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    @endif
                    <div class="card-body px-2">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-10">
                                    <span class="font-weight-bold">
                                        {{ $place->name }}
                                    </span>
                                </div>
                                <div class="col-2">
                                    @role('admin')
                                        @include('components.actions.admin.action-place', ['place' => $place])
                                    @endrole
                                </div>
                            </div>
                        </div>
                        <div class="col-12 pt-3">
                            {{ $place->description }}
                        </div>
                        @if(!empty($place->features))
                            <div class="col-12 pt-3">
                                {{ __('Features') }}: {{ $place->features }}
                            </div>
                        @endif
                    </div>
                    <div class="card-footer bg-transparent">
                        <div class="row">
                            <div class="col-6 text-muted small">
                                <span>
                                    {{ __('Created') }}: {{ $place->created_at }}
                                </span>
                            </div>
                            <div class="col-6 text-right">
                                <span class="px-2 text-success">@include('icons.arrow-up')</span>
                                <span class="px-2 text-muted">0</span>
                                <span class="px-2 text-danger">@include('icons.arrow-down')</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 pt-3">
                <div class="card text-center">
                    <div class="card-header bg-transparent">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="#">{{ __('Comments') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick="window.print()">{{ __('Print this place') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#">{{ __('Share') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                @if(!empty($comments))
                                    <div class="row">
                                        @foreach($comments as $comment)
                                            <div class="col-12 mb-3">
                                                <div class="row">
                                                    <div class="col-12 col-md-1">
                                                        <a href="{{ route('user.profile', ['user' => $comment['user_id']]) }}"
                                                           class="d-block avatar position-relative overflow-hidden rounded-circle bg-light text-center"
                                                           style="width: 50px;height:50px;"
                                                           title="{{ $comment['first_name'] . ' ' . $comment['last_name'] }}"
                                                        >
                                                            <img @if(isset($comment['avatar_alias']) && !empty($comment['avatar_alias'])) src="{{ asset('images/user_pic/' . $comment['user_id'] . '/' . $comment['avatar_alias']) }}" @endif
                                                                 class="position-absolute"
                                                                 style="left: 50%;top:50%;transform: translate(-50%, -50%);width: 100%;min-height: 100%">
                                                        </a>
                                                    </div>
                                                    <div class="col-12 col-md-11">
                                                        <div class="card rounded p-3">
                                                            <div class="card-body py-0">
                                                                {{ $comment['comment'] }}

                                                                <div class="small mt-1">
                                                                    - <a href="{{ route('user.profile', ['user' => $comment['user_id']]) }}" title="{{ $comment['first_name'] . ' ' . $comment['last_name'] }}">
                                                                         {{ $comment['first_name'] . ' ' . $comment['last_name'] }}
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="alert alert-warning d-block text-center text-muted">
                                        No comments. Be the first to comment!
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mt-3">
                                @guest
                                    <p class="card-text text-muted">Comments can be written only by authorized users</p>
                                    <a href="{{ route('login') }}" class="btn btn-link py-0 border-0">{{ __('Login') }}</a>
                                @else
                                    <form action="{{ route('places.comments.store', ['place' => $place->id]) }}" method="POST">
                                        @csrf()

                                        <div class="form-group">
                                            <textarea
                                                required
                                                placeholder="Your comment"
                                                class="w-100 form-control"
                                                name="comment"
                                                id="comment"
                                                rows="5"
                                                style="min-height: 150px;max-height: 150px"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-info text-white">{{ __('Leave Comment') }}</button>
                                        </div>
                                    </form>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
