@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card w-100">
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
                                        <div class="dropdown text-right">
                                            <button class="bg-white text-muted border-0 dropdown-toggle" type="button" id="dropdownMenuButtonPlace" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{ __('Admin Action') }}
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonPlace">
                                                <a class="dropdown-item" href="{{ route('admin.places.edit', ['place' => $place->id]) }}">{{ __('Edit Place') }}</a>
                                            </div>
                                        </div>
                                    @endrole
                                </div>
                            </div>
                        </div>
                        <div class="col-12 pt-3">
                            {{ $place->description }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
