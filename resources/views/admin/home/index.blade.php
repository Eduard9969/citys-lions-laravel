@extends('admin.layouts.app')

@section('content')
    <div class="container justify-content-center">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-4">
                        <a href="{{ route('laravelroles::roles.index') }}" class="card">
                            <div class="card-body py-2 text-center">
                                <span class="btn text-black border-0">
                                    {{ __('Roles Panel') }}
                                </span>
                            </div>
                        </a>
                    </div>

                    <div class="col-4">
                        <a href="{{ route('admin.places.list') }}" class="card">
                            <div class="card-body py-2 text-center">
                                <span class="btn text-black border-0">
                                    {{ __('Places') }}
                                </span>
                            </div>
                        </a>
                    </div>

                    <div class="col-4">
                        <a href="{{ route('admin.users.list') }}" class="card">
                            <div class="card-body py-2 text-center">
                                <span class="btn text-black border-0">
                                    {{ __('Users') }}
                                </span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-4">
                <div class="row">
                    <div class="col-4">
                        <a href="{{ route('admin.comments.list') }}" class="card">
                            <div class="card-body py-2 text-center">
                                <span class="btn text-black border-0">
                                    {{ __('Comments') }}
                                </span>
                            </div>
                        </a>
                    </div>

                    <div class="col-4">
                        <a href="{{ route('admin.places.list') }}" class="card">
                            <div class="card-body py-2 text-center">
                                <span class="btn text-black border-0">
                                    {{ __('Suggested places') }}
                                </span>
                            </div>
                        </a>
                    </div>

                    <div class="col-4">
                        <a href="{{ route('admin.users.list') }}" class="card">
                            <div class="card-body py-2 text-center">
                                <span class="btn text-black border-0">
                                    {{ __('Guides') }}
                                </span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <div class="card w-100">
                    <div class="card-header bg-white">
                        <span>{{ __('Last suggested places') }}</span>
                    </div>
                    <div class="card-body p-2">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="border-top-0">{{ __('Name') }}</th>
                                    <th class="border-top-0">{{ __('Description') }}</th>
                                    <th class="border-top-0">{{ __('Images') }}</th>
                                    <th class="border-top-0"></th>
                                </tr>
                            </thead>

                            <tbody>
                                @if(!empty($suggest))

                                @else
                                    <tr>
                                        <td class="text-center" colspan="4">
                                            {{ __('No places offered') }}
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
