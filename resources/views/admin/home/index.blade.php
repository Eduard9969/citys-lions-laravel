@extends('admin.layouts.app')

@section('content')
    <div class="container justify-content-center">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-4">
                        <a href="{{ route('laravelroles::roles.index') }}" class="card">
                            <div class="card-body py-2">
                                <span class="btn text-black border-0">
                                    {{ __('Roles Panel') }}
                                </span>
                            </div>
                        </a>
                    </div>

                    <div class="col-4">
                        <a href="{{ route('admin.places.list') }}" class="card">
                            <div class="card-body py-2">
                                <span class="btn text-black border-0">
                                    {{ __('Places') }}
                                </span>
                            </div>
                        </a>
                    </div>

                    <div class="col-4">
                        <a href="{{ route('admin.users.list') }}" class="card">
                            <div class="card-body py-2">
                                <span class="btn text-black border-0">
                                    {{ __('Users') }}
                                </span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
