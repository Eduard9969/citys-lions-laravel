<div class="dropdown text-right">
    <button
        class="bg-white text-muted border-0 dropdown-toggle"
        type="button"
        id="dropdownMenuButtonPlace"
        data-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false"
    >
        {{ __('Admin Action') }}
    </button>

    <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonPlace">
        <a class="dropdown-item" href="{{ route('admin.places.edit', ['place' => $place->id]) }}">
            {{ __('Edit Place') }}
        </a>
        <a class="dropdown-item" href="{{ route('admin.places.images.attach', ['place' => $place->id]) }}">
            {{ __('Edit Images') }}
        </a>
    </div>
</div>
