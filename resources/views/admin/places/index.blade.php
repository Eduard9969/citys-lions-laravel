@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="btn-group float-right">
            <a href="{{ route('admin.places.create')  }}" class="btn btn-success">
                {{ __('Add new Place') }}
            </a>
        </div>
        <div class="clearfix"></div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="border-top-0" width="15%">{{ __('Name') }}</th>
                                <th class="border-top-0" width="30%">{{ __('Description') }}</th>
                                <th class="border-top-0" width="15%">{{ __('Features') }}</th>
                                <th class="border-top-0" width="10%">{{ __('Status') }}</th>
                                <th class="border-top-0" width="20%">{{ __('Created At') }}</th>
                                <th class="border-top-0" width="10%"></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($places as $place)
                                <tr>
                                    <td>{{ $place->name }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($place->description, 100, $end='...') }}</td>
                                    <td>{{ !empty($place->features) ? $place->features : '-' }}</td>
                                    <td>{{ isset($places_statuses[$place->status_id]) ? ucfirst($places_statuses[$place->status_id]) : '-' }}</td>
                                    <td>{{ date('Y-m-d H:i', strtotime($place->created_at)) }}</td>
                                    <td>
                                        <div class="justify-content-center">
                                            <a href="{{ route('admin.places.edit', ['place' => $place->id]) }}" class="d-block">
                                                {{ __('Edit') }}
                                            </a>

                                            <a href="#"  class="d-block" onclick="event.preventDefault();document.getElementById('delete-form-{{ $place->id }}').submit();">
                                                {{ __('Delete') }}
                                            </a>
                                            <form id="delete-form-{{ $place->id }}" action="{{ route('admin.places.delete', ['place' => $place->id]) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $places->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
