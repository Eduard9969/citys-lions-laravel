<div class="row">
    <div class="col-12 col-md-1">
        <a href="{{ route('user.profile', ['user' => $comment['user_id']]) }}"
           class="d-block avatar position-relative overflow-hidden rounded-circle bg-light text-center"
           style="width: 50px;height:50px;"
           title="{{ $comment['first_name'] . ' ' . $comment['last_name'] }}"
        >
            <img @if(isset($comment['avatar_alias']) && !empty($comment['avatar_alias'])) src="{{ asset('images/user_pic/' . $comment['user_id'] . '/' . $comment['avatar_alias']) }}" @endif
            class="position-absolute"
                 style="left: 50%;top:50%;transform: translate(-50%, -50%);width: 100%;min-height: 100%">
        </a>
    </div>
    <div class="col-12 col-md-11">
        <div class="card rounded p-3">
            <div class="card-body py-0">
                {{ $comment['comment'] }}

                <div class="small mt-1">
                    - <a href="{{ route('user.profile', ['user' => $comment['user_id']]) }}" title="{{ $comment['first_name'] . ' ' . $comment['last_name'] }}">
                        {{ $comment['first_name'] . ' ' . $comment['last_name'] }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
