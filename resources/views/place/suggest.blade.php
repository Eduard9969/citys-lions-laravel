@extends('layouts.app')

@section('content')
    <div class="container justify-content-center">
        <div class="row">
            <div class="col-12">
                <div class="card w-100">
                    <div class="card-header">{{ __('Suggest new Place') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('places.suggest.create') }}" >
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input required id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="@if(!empty(old('name'))) {{ old('name') }} @elseif(isset($place['name'])){{ $place['name'] }} @endif">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <textarea required class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="5" class="w-100">{{ !empty(old('description')) ? old('description') : (!empty($place['description']) ? $place['description'] : '') }}</textarea>
                                    {{--                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" value="@if(!empty(old('name'))) {{ old('name') }} @elseif(isset($place['name'])){{ $place['name'] }} @endif">--}}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="features" class="col-md-4 col-form-label text-md-right">{{ __('Features') }}</label>

                                <div class="col-md-6">
                                    <textarea class="form-control @error('features') is-invalid @enderror" name="features" id="features" cols="30" rows="2" class="w-100">{{ !empty(old('features')) ? old('features') : (!empty($place['features']) ? $place['features'] : '') }}</textarea>
                                </div>
                            </div>

                            <input type="hidden" name="status_id" value="0">

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Suggest new Place') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <div class="card w-100">
                    <div class="card-header">{{ __('Your suggested places') }}</div>

                    <div class="card-body pb-0">
                        @if(!empty($suggest))
                            <span class="alert alert-warning w-100 d-block">
                                {{ __('Places are awaiting moderation. After moderation, they will be excluded from the list.') }}
                            </span>

                            <table class="table mt-3">
                                <thead>
                                    <tr>
                                        <th class="border-top-0">{{ __('Name') }}</th>
                                        <th class="border-top-0">{{ __('Description') }}</th>
                                        <th class="border-top-0">{{ __('Features') }}</th>
                                        <th class="border-top-0">{{ __('Created At') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($suggest as $item)
                                        <tr>
                                            <td width="20%" class="text-break">
                                                {{ $item['name'] }}
                                            </td>
                                            <td width="40%" class="text-break">
                                                {{ \Illuminate\Support\Str::limit($item['description'], 125, $end='...') }}
                                            </td>
                                            <td width="25%" class="text-break">
                                                {{ $item['features'] }}
                                            </td>
                                            <td width="15%">
                                                {{ date('Y-m-d H:i', strtotime($item['created_at'])) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <span class="text-center w-100 d-block">
                                {{ __('You have no suggested places') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
