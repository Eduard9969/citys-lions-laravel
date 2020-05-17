@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 mb-4 mb-md-0">
                <div class="row">
                    @if(!empty($places))
                        <div class="col-12 mb-3 py-0">
                            <div class="card">
                                <div class="card-body py-2">
                                    <div class="row">
                                        <div class="col-6">
                                            <span class="d-flex align-items-center h-100 small">
                                                <span>
                                                    {{ __('Total Places') . ': ' . $places->total() }}
                                                </span>
                                                <span class="px-2">|</span>
                                                <span>
                                                    {{ __('Current Page') . ': ' . $places->currentPage() }}
                                                </span>
                                            </span>
                                        </div>
                                        <div class="col-6 small">
                                            @include('components.forms.place-sort', ['places' => $places])
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="border-top mt-3"></div>
                        </div>
                    @endif

                    @include('components.list.place', ['places' => $places])

                    @if(!empty($places))
                        <div class="col-12">
                            {{ $places->appends(['sort_by' => (!empty($sort) ? $sort : 'created_at_desc'), 'filter' => ''])->links() }}
                        </div>
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
