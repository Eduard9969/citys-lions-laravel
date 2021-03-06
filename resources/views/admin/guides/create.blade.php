@extends('admin.layouts.app')

@section('content')
    <div class="container justify-content-center">
        <div class="row">
            <div class="col-12">
                <div class="card w-100">
                    <div class="card-header">{{ __((!empty($guide) ? 'Edit' : 'Add new') . ' Guide') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ !empty($guide) ? route('admin.guides.update', ['guide' => $guide->id]) : route('admin.guides.store') }}" >
                            @csrf

                            @if(!empty($guide))
                                @method('PUT')
                            @endif

                            <div class="form-group row">
                                <label for="user" class="col-md-4 col-form-label text-md-right">{{ __('User') }}</label>
                                <div class="col-md-6">
                                    <select required name="user_id" id="user" class="form-control custom-select @error('user_id') is-invalid @enderror">
                                        <option value="-1">{{ __('Select User') }}</option>
                                        @if(isset($users))
                                            @foreach($users as $key => $user)
                                                <option {{ ( ((!empty(old('user_id')) && old('user_id') == $user['id']) || (!empty($guide['user_id']) && $guide['user_id'] == $user['id'])) ? 'selected' : '' ) }} value="{{ $user['id'] }}">{{ __(ucfirst($user['login'])) }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                                <div class="col-md-6">
                                    <input required id="phone" type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="@if(!empty(old('phone'))) {{ old('phone') }} @elseif(isset($guide['phone'])){{ $guide['phone'] }} @endif">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="5" class="w-100">{{ !empty(old('description')) ? old('description') : (!empty($guide['description']) ? $guide['description'] : '') }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Guide Status') }}</label>
                                <div class="col-md-6">
                                    <select required name="status_id" id="status" class="form-control custom-select @error('status_id') is-invalid @enderror">
                                        <option value="-1">{{ __('Guide Status') }}</option>
                                        @if(isset($guide_statuses))
                                            @foreach($guide_statuses as $key => $status)
                                                <option {{ ( ((!empty(old('status_id')) && old('status_id') == $status) || (!empty($guide['status_id']) && $guide['status_id'] == $status)) ? 'selected' : '' ) }} value="{{ $status }}">{{ __(ucfirst($key)) }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __(empty($guide) ? 'Add new Guide' : 'Update Guide') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
