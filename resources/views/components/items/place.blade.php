<div class="col-12 pb-3">
    <div class="card w-100">
        @if(isset($place->main_poster) && !empty($place->main_poster))
            <a style="max-height: 250px;overflow: hidden"
               href="{{ route('places.show', ['place' => $place->id]) }}"
               title="{{ $place->name }}">
                <img class="card-img-top"
                     src="{{ asset('images/places/' . $place->id . '/' . $place->main_poster) }}"
                     alt="{{ $place->name }}">
            </a>
        @endif

        <div class="card-body p-3">
            <div class="row">
                @if($place->name)
                    <div class="col-12">
                        <a href="{{ route('places.show', ['place' => $place->id]) }}" class="font-weight-bold">{{ $place->name }}</a>
                    </div>
                @endif
                @if($place->description)
                    <div class="col-12 pt-2">
                        {{ \Illuminate\Support\Str::limit($place->description, 150, $end='...') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
