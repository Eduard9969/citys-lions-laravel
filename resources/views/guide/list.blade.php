@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @auth()
                <div class="col-12 text-right mb-3">
                    <a href="{{ !empty($user_guide) ? route('guides.edit', ['guide' => $user_guide->id]) : route('guides.create') }}" class="btn {{ !empty($user_guide) ? 'btn-link' : 'btn-success' }}">
                        {{ __(!empty($user_guide) ? 'Edit Guide Profile' : 'I\'m a guide') }}
                    </a>
                    @if(!empty($user_guide))
                        <a href="#" class="btn btn-danger" onclick="event.preventDefault();document.getElementById('delete-form-{{ $user_guide->id }}').submit();">
                            {{ __('Delete') }}
                        </a>
                        <form id="delete-form-{{ $user_guide->id }}" action="{{ route('admin.guides.delete', ['guide' => $user_guide->id]) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endif
                </div>
            @endauth
            @forelse($guides as $guide)
                <div class="col-12 col-md-3">
                    <div class="card justify-content-center">
                        <div class="card-body">
                            <div class="avatar position-relative overflow-hidden rounded-circle bg-light text-center m-auto" style="width: 150px;height:150px;">
                                <img @if(isset($guide->user->avatar_alias) && !empty($guide->user->avatar_alias)) src="{{ asset('images/user_pic/' . $guide->user->id . '/' . $guide->user->id) }}" @endif
                                class="position-absolute"
                                     style="left: 50%;top:50%;transform: translate(-50%, -50%);width: 100%;min-height: 100%">
                            </div>
                            <div class="text-black-50 text-center mt-3 small text-uppercase">
                                {{ __('Guide') }}
                            </div>
                            <div class="text-center">
                                {{ $guide->user->first_name . ' ' . $guide->user->last_name }}
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-outline-info d-block m-auto" data-toggle="modal" data-target="#guideModal{{$guide->id}}">
                                    {{ __('Detail') }}
                                </button>
                            </div>
                        </div>
                        <div class="card-footer">
                            <span class="text-black-50">{{ __('Phone') }}: {{ $guide->phone }}</span>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="guideModal{{$guide->id}}" tabindex="-1" role="dialog" aria-labelledby="guideModal{{$guide->id}}Label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Guide') }}: {{ $guide->user->first_name . ' ' . $guide->user->last_name }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="avatar position-relative overflow-hidden rounded-circle bg-light text-center m-auto" style="width: 125px;height:125px;">
                                                <img @if(isset($guide->user->avatar_alias) && !empty($guide->user->avatar_alias)) src="{{ asset('images/user_pic/' . $guide->user->id . '/' . $guide->user->id) }}" @endif
                                                class="position-absolute"
                                                     style="left: 50%;top:50%;transform: translate(-50%, -50%);width: 100%;min-height: 100%">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="d-block small text-muted">{{ __('First Name') }}:</span>
                                                    <span class="d-block">{{ $guide->user->first_name }}</span>
                                                </div>
                                                <div class="col-12">
                                                    <span class="d-block small text-muted">{{ __('Last Name') }}:</span>
                                                    <span class="d-block">{{ $guide->user->last_name }}</span>
                                                </div>
                                                <div class="col-12">
                                                    <span class="d-block small text-muted">{{ __('Phone') }}:</span>
                                                    <span class="d-block">{{ $guide->phone }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 mt-3">
                                            <span class="d-block small text-muted">{{ __('Description') }}:</span>
                                            <span class="d-block">{{ !empty($guide->description) ? $guide->description : '-' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    {{ __('Empty List') }}
                </div>
            @endforelse

            @if(!empty($guides))
                <div class="col-12">
                    {{ $guides->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
