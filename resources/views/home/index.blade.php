@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="row">
                    @forelse($places as $place)
                        <div class="col-12 pb-3">
                            <div class="card w-100 p-2">
                                <div class="card-body">
                                    <div class="row">
                                        @if($place->name)
                                            <div class="col-12">
                                                <a href="{{ route('places.show', ['place' => $place->id]) }}" class="font-weight-bold">{{ $place->name }}</a>
                                            </div>
                                        @endif
                                        @if($place->description)
                                            <div class="col-12 pt-2">
                                                {{ \Illuminate\Support\Str::limit($place->description, 150, $end='...') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="card w-100 p-2">
                                <div class="card-body">
                                    <p>{{ __('Empty List') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforelse

                    @if(!empty($places))
                        <div class="col-12 justify-content-center text-center mt-3">
                            <a href="{{ route('places.list') }}" class="btn btn-outline-secondary">{{ __('Show All Places') }}</a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-4">
                sidebar
            </div>
        </div>
    </div>
@endsection
