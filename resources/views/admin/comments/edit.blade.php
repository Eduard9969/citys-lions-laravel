@extends('admin.layouts.app')

@section('content')
    <div class="container justify-content-center">
        <div class="row">
            <div class="col-12">
                <div class="card w-100">
                    <div class="card-header">{{ __('Edit Comment') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.comments.update', ['comment' => $comment['id']]) }}" >
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="user" class="col-md-4 col-form-label text-md-right">{{ __('Author Login') }}</label>

                                <div class="col-md-6">
                                    <input readonly id="user" type="text" class="form-control" value="{{ $comment['user']['login'] }}, ID: {{ $comment['user']['id'] }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user" class="col-md-4 col-form-label text-md-right">{{ __('Place') }}</label>

                                <div class="col-md-6">
                                    <input readonly id="user" type="text" class="form-control" value="{{ $comment['place']['name'] }}, ID: {{ $comment['place']['id'] }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="comment" class="col-md-4 col-form-label text-md-right">{{ __('Comment') }}</label>

                                <div class="col-md-6">
                                    <textarea required class="form-control @error('comment') is-invalid @enderror" name="comment" id="comment" cols="30" rows="5" class="w-100">{{ !empty(old('comment')) ? old('comment') : (!empty($comment['comment']) ? $comment['comment'] : '') }}</textarea>
{{--                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" value="@if(!empty(old('name'))) {{ old('name') }} @elseif(isset($place['name'])){{ $place['name'] }} @endif">--}}
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update Comment') }}
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
