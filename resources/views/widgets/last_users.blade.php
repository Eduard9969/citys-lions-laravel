<div class="card">

    <div class="card-header">
        {{ __('Last Users') }}
    </div>

    <div class="card-body">
        @if(!empty($users))
            <table class="table">
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="{{ $loop->first ? 'border-top-0' : ''  }}">
                                <a href="{{ route('user.profile', ['user' => $user['id']]) }}">
                                    {{ !empty($user['first_name']) && !empty($user['last_name'])
                                            ? $user['first_name'] . ' ' . $user['last_name'] : __('Incognito') }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
