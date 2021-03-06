@guest
    <div class="d-inline-block align-top d-print-none">
        <a href="{{ route('login') }}" class="px-2 text-muted" style="cursor: pointer">@include('icons.arrow-up')</a>
    </div>

    <div class="d-inline-block align-top">
        <span class="px-2 {{ $rating['value'] > 0 ? 'text-success' : ($rating['value'] < 0 ? 'text-danger' : 'text-muted') }}">
            <span class="d-none d-print-inline-block">Rating:</span> <span>{{ $rating['value'] }}</span>
        </span>
    </div>

    <div class="d-inline-block align-top d-print-none">
        <a href="{{ route('login') }}" class="px-2 text-muted" style="cursor: pointer">@include('icons.arrow-down')</a>
    </div>
@else
    @if(isset($rating) && isset($place_id) && isset($user_rating))
        <form action="{{ !isset($user_rating['id']) ? route('places.rating.store') : route('places.rating.update', ['rating' => $user_rating['id']]) }}" id="rating" method="POST">
            @csrf()

            @if(isset($user_rating['id']))
                @method('PUT')
            @endif

            <input type="hidden" name="place_id" value="{{ $place_id }}">

            <div class="d-inline-block align-top d-print-none">
                <label class="px-2 text-success" style="cursor: pointer" for="up">@include('icons.arrow-up')</label>
                <input type="radio" class="d-none" onchange="document.querySelector('form#rating').submit()" name="rating" id="up" value="up">
            </div>

            <div class="d-inline-block align-top">
                <span class="px-2 {{ $rating['value'] > 0 ? 'text-success' : ($rating['value'] < 0 ? 'text-danger' : 'text-muted') }}">
                    <span class="d-none d-print-inline-block">Rating:</span> <span>{{ $rating['value'] }}</span>
                </span>
            </div>

            <div class="d-inline-block align-top d-print-none">
                <label class="px-2 text-danger" style="cursor: pointer" for="down">@include('icons.arrow-down')</label>
                <input type="radio" class="d-none" onchange="document.querySelector('form#rating').submit()" name="rating" id="down" value="down">
            </div>
        </form>
    @endif
@endguest
