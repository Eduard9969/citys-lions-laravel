@if(!empty($comments))
<div class="card mb-3">

    <div class="card-header">
        {{ __('Last Comments') }}
    </div>

    <div class="card-body py-0">
        <table class="table">
            <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td class="px-0 {{ $loop->first ? 'border-top-0' : ''  }}">
                        <span class="d-block">
                            <a href="{{ route('places.show', ['place' => $comment['place_id']]) }}" class="text-black">
                                {{ \Illuminate\Support\Str::limit($comment['comment'], 25, $end='...') }}
                            </a>
                        </span>
                        <span class="d-block">
                            <a href="{{ route('user.profile', ['user' => $comment['user_id']]) }}" class="text-muted">
                                {{ $comment['first_name'] . ' ' . $comment['last_name'] }}
                            </a>
                        </span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
