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
                <div class="card px-5">
                    <table>
                        <thead>
                            <th>-</th>
                            <th>-</th>
                            <th>-</th>
                            <th>-</th>
                        </thead>

                        <tbody>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
