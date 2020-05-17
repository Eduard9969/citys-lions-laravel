@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 mb-4 mb-md-0">
                <div class="row">
                    @include('components.list.place', ['places' => $places])

                    @if(!empty($places))
                        <div class="col-12 justify-content-center text-center mt-3">
                            <a href="{{ route('places.list') }}" class="btn btn-outline-secondary">
                                {{ __('Show All Places') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-12 col-md-4">
                @include('components.sidebars.main')
            </div>
        </div>
    </div>
@endsection
