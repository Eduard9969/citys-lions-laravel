<div class="col-12 pb-3">
    <div class="card w-100 p-2">
        <div class="card-body">
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
