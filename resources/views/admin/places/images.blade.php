@extends('admin.layouts.app')

@section('content')
    <div class="container justify-content-center">
        <div class="row">
            <div class="col-12">
                <div class="card w-100">
                    <div class="card-header">{{ __('Attach Images') }}{{ !empty($place) ? ' - ' . $place->name : '' }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.places.images.store', ['place' => $place->id]) }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row-image">
                                <div class="form-group row">
                                    <label for="" class="col-md-4 col-form-label text-md-right">{{ __('Main Poster') }}</label>
                                    <div class="col-md-6">
                                        @if(!empty($main_poster))
                                            <div class="row">
                                                <div class="col-12 pb-3">
                                                    <a class="poster_place-thumb" data-fancybox href="{{ asset('images/places/' . $place->id . '/' . $main_poster['alias']) }}">
                                                        <img class="img-fluid" src="{{ asset('images/places/' . $place->id . '/' . $main_poster['alias']) }}" alt="{{ $place->name }}">
                                                    </a>

                                                    <div class="w-100 text-center">
                                                        <a href="#" onclick="event.preventDefault();document.getElementById('delete-form-{{ $main_poster['id'] }}').submit();">{{ __('Delete Image') }}</a>

                                                        <input type="hidden" name="poster[added][]" value="{{ $main_poster['id'] }}">
                                                        <form id="delete-form-{{ $main_poster['id'] }}"
                                                              action="{{ route('admin.places.images.delete', ['place_picture' => $main_poster['id']]) }}"
                                                              method="POST"
                                                              style="display: none;">
                                                            @csrf()
                                                            @method('DELETE')
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="poster[main][]" class="custom-file-input" id="mainImg" required>
                                                <label class="custom-file-label" for="mainImg">{{ __('Choose Main Image...') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if(!empty($posters))
                                    <div class="col-12 border-top pb-3"></div>

                                    <div class="form-group row">
                                        <label for="otherImg" class="col-md-4 col-form-label text-md-right">{{ __('Added Images') }}</label>
                                        <div class="col-md-6">
                                            <div class="row">
                                                @foreach($posters as $poster)
                                                    <div class="col-12 pb-3">
                                                        <a class="poster_place-thumb m-auto d-block overflow-hidden h-auto" style="max-height: 200px;width: auto;" data-fancybox="gallery" href="{{ asset('images/places/' . $place->id . '/' . $poster['alias']) }}">
                                                            <img class="img-fluid" src="{{ asset('images/places/' . $place->id . '/' . $poster['alias']) }}" alt="{{ $place->name }}">
                                                        </a>
                                                        <div class="w-100 text-center">
                                                            <a href="#" onclick="event.preventDefault();document.getElementById('delete-form-{{ $poster['id'] }}').submit();">{{ __('Delete Image') }}</a>

                                                            <input type="hidden" name="poster[added][]" value="{{ $poster['id'] }}">
                                                            <form id="delete-form-{{ $poster['id'] }}"
                                                                  action="{{ route('admin.places.images.delete', ['place_picture' => $poster['id']]) }}"
                                                                  method="POST"
                                                                  style="display: none;">
                                                                @csrf()
                                                                @method('DELETE')
                                                            </form>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-12 border-top pb-3"></div>

                                <div class="form-group row origin-field">
                                    <label for="otherImg" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="poster[other][]" class="custom-file-input" id="otherImg" required>
                                                <label class="custom-file-label" for="otherImg">{{ __('Choose Image...') }}</label>
                                                <span class="text-hide-label d-none">{{ __('Choose Image...') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4 text-md-right">
                                    <span class="btn btn-sm btn-outline-info" id="cloneImgInput">
                                        {{ __('Add another image') }}
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update Images') }}
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
