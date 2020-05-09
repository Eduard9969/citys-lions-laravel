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
                                <span class="sr-only">{{ __('Previous') }}</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselSliderPosters" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">{{ __('Next') }}</span>
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
                                @include('components.forms.place-rating', ['rating' => $rating, 'place_id' => $place->id])
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
                                    @include('components.list.comments', ['comments' => $comments])
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
                                    @include('components.forms.comment-add', ['place' => $place])
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
