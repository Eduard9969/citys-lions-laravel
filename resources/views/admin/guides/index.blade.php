@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="btn-group float-right">
            <a href="{{ route('admin.guides.create')  }}" class="btn btn-success">
                {{ __('Add new Guide') }}
            </a>
        </div>

        <div class="clearfix"></div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="border-top-0" width="15%">{{ __('User') }}</th>
                                <th class="border-top-0" width="15%">{{ __('Phone') }}</th>
                                <th class="border-top-0" width="30%">{{ __('Description') }}</th>
                                <th class="border-top-0" width="10%">{{ __('Status') }}</th>
                                <th class="border-top-0" width="15%">{{ __('Created At') }}</th>
                                <th class="border-top-0" width="15%"></th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($guides as $guide)
                                <tr>
                                    <td>
                                        <a href="{{ route('user.user', ['user' => $guide->user->id]) }}" target="_blank">
                                            @if(!empty($guide->user->first_name) && !empty($guide->user->last_name))
                                                {{ $guide->user->first_name . ' ' . $guide->user->last_name }}
                                            @else
                                                {{ $guide->login }}
                                            @endif
                                        </a>
                                    </td>
                                    <td>{{ $guide->phone }}</td>
                                    <td>
                                        @if(!empty($guide->description))
                                           {{ \Illuminate\Support\Str::limit($guide->description, 100, $end='...') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ isset($guide_statuses[$guide->status_id]) ? ucfirst($guide_statuses[$guide->status_id]) : '-' }}</td>
                                    <td>{{ date('Y-m-d H:i', strtotime($guide->created_at)) }}</td>
                                    <td>
                                        <div class="justify-content-center">
                                            <a href="{{ route('admin.guides.edit', ['guide' => $guide->id]) }}" class="d-block">
                                                {{ __('Edit') }}
                                            </a>

                                            <a href="#"  class="d-block" onclick="event.preventDefault();document.getElementById('delete-form-{{ $guide->id }}').submit();">
                                                {{ __('Delete') }}
                                            </a>
                                            <form id="delete-form-{{ $guide->id }}" action="{{ route('admin.guides.delete', ['guide' => $guide->id]) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" align="center">
                                        {{ __('Empty List') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $guides->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
