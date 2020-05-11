@extends('admin.layouts.app')

@section('content')
    <div class="container justify-content-center">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-transparent">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link{{ is_null($status_id) ? ' active' : '' }}" href="{{ route('admin.suggest.list') }}">All</a>
                            </li>

                            @foreach($statuses as $key => $status)
                                <li class="nav-item">
                                    <a class="nav-link{{ !is_null($status_id) && $status_id == $key ? ' active' : '' }}" href="{{ route('admin.suggest.list') }}?status_id={{$key}}">{{ $status }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="card-body">
                        @if(!empty($suggest_list->total()))
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="border-top-0">{{ __('Name') }}</th>
                                        <th class="border-top-0">{{ __('Description') }}</th>
                                        <th class="border-top-0 text-center">{{ __('Status') }}</th>
                                        <th class="border-top-0 text-center">{{ __('Proposed') }}</th>
                                        <th class="border-top-0 text-center">{{ __('Created At') }}</th>
                                        <th class="border-top-0 text-center">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($suggest_list as $suggest)
                                        <tr>
                                            <td width="20%" class="text-break">{{ $suggest->name }}</td>
                                            <td width="35%" class="text-break">
                                                {{ \Illuminate\Support\Str::limit($suggest->description, 125, $end='...') }}
                                            </td>
                                            <td class="text-center">{{ $statuses[$suggest->status_id] }}</td>
                                            <td width="20" class="text-center">
                                                <a target="_blank" href="{{ route('user.profile', ['user' => $suggest->user_id]) }}">
                                                    {{ $suggest->first_name . ' ' . $suggest->last_name }}
                                                </a>
                                            </td>
                                            <td width="15%" class="text-center">{{ date('Y-m-d H:i', strtotime($suggest->created_at)) }}</td>
                                            <td width="10%" class="text-center"><a href="{{ route('admin.suggest.item', ['suggest' => $suggest->id]) }}">{{ __('View') }}</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{ $suggest_list->links() }}
                        @else
                            <span class="d-block w-100 my-3 text-center">
                                {{ __('No Data') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
