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
                        <a href="{{ route('admin.users.list') }}" class="card bg-light">
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
                        <a href="{{ route('admin.suggest.list') }}" class="card">
                            <div class="card-body py-2 text-center">
                                <span class="btn text-black border-0">
                                    {{ __('Suggested places') }}
                                </span>
                            </div>
                        </a>
                    </div>

                    <div class="col-4">
                        <a href="{{ route('admin.guides.list') }}" class="card">
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
                        @if(!empty($suggest))
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="border-top-0">{{ __('Name') }}</th>
                                        <th class="border-top-0">{{ __('Description') }}</th>
                                        <th class="border-top-0 text-center">{{ __('User Proposed') }}</th>
                                        <th class="border-top-0 text-center">{{ __('Created At') }}</th>
                                        <th class="border-top-0"></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($suggest as $item)
                                        <tr>
                                            <td width="15%" class="text-break">{{ $item['name'] }}</td>
                                            <td width="40%" class="text-break">
                                                {{ \Illuminate\Support\Str::limit($item['description'], 125, $end='...') }}
                                            </td>
                                            <td width="15%" class="text-center">
                                                <a target="_blank" href="{{ route('user.profile', ['user' => $item['user_id']]) }}">
                                                    {{ $item['first_name'] . ' ' . $item['last_name'] }}
                                                </a>
                                            </td>
                                            <td width="15%" class="text-center">
                                                {{ date('Y-m-d H:i', strtotime($item['created_at'])) }}
                                            </td>
                                            <td width="10%" class="text-center">
                                                <a href="{{ route('admin.suggest.item', ['suggest' => $item['id']]) }}">{{ __('View') }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <span class="d-block w-100 my-3 text-center">
                                {{ __('No places suggest') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
