@extends('admin.layouts.app')

@section('content')
    <div class="container justify-content-center">
        <div class="row">
            <div class="col-12">
                <div class="card w-100">
                    <div class="card-header">{{ __('Add new Place') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ !empty($place) ? route('admin.places.update', ['place' => $place->id]) : route('admin.places.store') }}" >
                            @csrf

                            @if(!empty($place))
                                @method('PUT')
                            @endif

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

                            <div class="form-group row">
                                <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Place Status') }}</label>
                                <div class="col-md-6">
                                    <select required name="status_id" id="status" class="form-control custom-select @error('status_id') is-invalid @enderror">
                                        <option value="-1">{{ __('Place Status') }}</option>
                                        @if(isset($places_statuses))
                                            @foreach($places_statuses as $key => $status)
                                                <option {{ ( ((!empty(old('status_id')) && old('status_id') == $status) || (!empty($place['status_id']) && $place['status_id'] == $status)) ? 'selected' : '' ) }} value="{{ $status }}">{{ __(ucfirst($key)) }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __(empty($place) ? 'Add new Place' : 'Update Place') }}
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
