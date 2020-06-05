@extends('admin.layouts.app')

@section('content')
    <div class="container">
{{--        <div class="btn-group float-right">--}}
{{--            <a href="{{ route('admin.places.create')  }}" class="btn btn-success">--}}
{{--                {{ __('Add new Place') }}--}}
{{--            </a>--}}
{{--        </div>--}}
        <div class="clearfix"></div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="border-top-0" width="5%">{{ __('#') }}</th>
                                <th class="border-top-0" width="35%">{{ __('Comment') }}</th>
                                <th class="border-top-0" width="15%">{{ __('Created At') }}</th>
                                <th class="border-top-0" width="20%">{{ __('Place') }}</th>
                                <th class="border-top-0" width="15%">{{ __('Author') }}</th>
                                <th class="border-top-0" width="10%"></th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($comments as $comment)
                                <tr>
                                    <td>
                                        {{ $comment->id }}
                                    </td>
                                    <td>
                                        {{ \Illuminate\Support\Str::limit($comment->comment, 100, $end='...') }}
                                    </td>
                                    <td>
                                        {{ date('Y-m-d H:i', strtotime($comment->created_at)) }}
                                    </td>
                                    <td>
                                        <a target="_blank" href="{{ route('places.show', ['place' => $comment->place->id]) }}">
                                            {{ $comment->place->name }}
                                        </a>
                                    </td>
                                    <td>
                                        <a target="_blank" href="{{ route('user.user', ['user' => $comment->user->id]) }}">
                                            {{ $comment->user->login  }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.comments.edit', ['comment' => $comment->id]) }}">{{ __('Edit') }}</a>
                                        <a href="#"  class="d-block" onclick="event.preventDefault();document.getElementById('delete-form-{{ $comment->id }}').submit();">
                                            {{ __('Delete') }}
                                        </a>
                                        <form id="delete-form-{{ $comment->id }}" action="{{ route('admin.comments.delete', ['comment' => $comment->id]) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
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

                    {{ $comments->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
