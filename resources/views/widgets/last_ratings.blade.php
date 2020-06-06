<div class="card mb-3">

    <div class="card-header">
        {{ __('Ratings Update') }}
    </div>

    <div class="card-body py-0">
        <table class="table">
            <tbody>
            @forelse($ratings as $rating)
                <tr>
                    <td class="px-0 {{ $loop->first ? 'border-top-0' : ''  }}">
                        <span class="d-block">
                            <a href="{{ route('places.show', ['place' => $rating['place_id']]) }}" class="text-black">
                                {{ \Illuminate\Support\Str::limit($rating['name'], 25, $end='...') }}
                            </a>
                        </span>
                        <span class="d-block small">
                            <a href="{{ route('user.profile', ['user' => $rating['user_id']]) }}" class="text-muted">
                                {{ $rating['first_name'] . ' ' . $rating['last_name'] }}
                            </a>
                        </span>
                    </td>
                    <td style="height: 40px;" class="text-right px-0 {{ $loop->first ? 'border-top-0' : ''  }}">
                        <span style="min-height: 100%" class="d-flex justify-content-end align-items-center text-{{ $rating['rating'] > 0 ? 'success' : 'danger' }}">
                            {{ $rating['rating'] > 0 ? '+' : '-' }}1
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td>
                        {{ __('No Data') }}
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
