@if(!empty($users))
    <div class="card mb-3">

        <div class="card-header">
            {{ __('New Users') }}
        </div>

        <div class="card-body py-0">
                <table class="table">
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="px-0 {{ $loop->first ? 'border-top-0' : ''  }}">
                                    <a href="{{ route('user.profile', ['user' => $user['id']]) }}" class="text-decoration-none">
                                        <div class="d-inline-block align-middle avatar position-relative overflow-hidden rounded-circle bg-light text-center"
                                           style="width: 25px;height:25px;"
                                           title="{{ $user['first_name'] . ' ' . $user['last_name'] }}"
                                        >
                                            <img @if(isset($user['avatar_alias']) && !empty($user['avatar_alias'])) src="{{ asset('images/user_pic/' . $user['id'] . '/' . $user['avatar_alias']) }}" @endif
                                                 class="position-absolute"
                                                 style="left: 50%;top:50%;transform: translate(-50%, -50%);width: 100%;min-height: 100%">
                                        </div>

                                        <div class="d-inline-block align-middle pl-2">
                                            {{ !empty($user['first_name']) && !empty($user['last_name'])
                                                    ? $user['first_name'] . ' ' . $user['last_name'] : __('Incognito') }}
                                        </div>

                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
@endif
