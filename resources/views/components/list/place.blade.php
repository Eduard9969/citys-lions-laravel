@forelse($places as $place)
    @include('components.items.place', ['place' => $place])
@empty
    <div class="col-12">
        <div class="card w-100 p-2">
            <div class="card-body">
                <p>{{ __('Empty List') }}</p>
            </div>
        </div>
    </div>
@endforelse
