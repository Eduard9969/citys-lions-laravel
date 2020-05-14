@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 mb-4 mb-md-0">
                <div class="row">
                    @include('components.list.place', ['places' => $places])


                    @if(!empty($places))
                        {{ $places->links() }}
                    @endif
                </div>
            </div>

            <div class="col-12 col-md-4">
{{--                @include('components.forms.place-filter', ['filter' => []])--}}
                @include('components.sidebars.main')
            </div>
        </div>
    </div>
@endsection
