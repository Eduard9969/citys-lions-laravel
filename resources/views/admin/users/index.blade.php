@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="btn-group float-right">
            <a href="{{ route('admin.users.create')  }}" class="btn btn-success">
                {{ __('Add new User') }}
            </a>
        </div>
        <div class="clearfix"></div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="border-top-0" width="5%">{{ __('ID') }}</th>
                            <th class="border-top-0" width="15%">{{ __('Login') }}</th>
                            <th class="border-top-0" width="20%">{{ __('Full name') }}</th>
                            <th class="border-top-0" width="15%">{{ __('Email') }}</th>
                            <th class="border-top-0" width="15%">{{ __('Status') }}</th>
                            <th class="border-top-0" width="15%">{{ __('Created At') }}</th>
                            <th class="border-top-0" width="15%"></th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->login }}</td>
                                <td>{{ $user->first_name . ' ' . $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ isset($users_statuses[$user->status_id]) ? ucfirst($users_statuses[$user->status_id]) : '-' }}</td>
                                <td>{{ date('Y-m-d H:i', strtotime($user->created_at)) }}</td>
                                <td>
                                    <div class="justify-content-center">
                                        <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}" class="d-block">
                                            {{ __('Edit') }}
                                        </a>

                                        <a href="#"  class="d-block text-danger" onclick="event.preventDefault();document.getElementById('delete-form-{{ $user->id }}').submit();">
                                            {{ __('Deactivate') }}
                                        </a>
                                        <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.delete', ['user' => $user->id]) }}" method="POST" style="display: none;">
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

                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
