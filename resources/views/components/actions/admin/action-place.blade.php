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

        @if($place->status_id == 1)
            <div class="dropdown-divider"></div>

            <a class="dropdown-item" href="{{ route('admin.places.delete', ['place' => $place->id]) }}"
               onclick="event.preventDefault();document.getElementById('delete-place-form').submit();">
                {{ __('Delete Place') }}
            </a>
            <form id="delete-place-form" action="{{ route('admin.places.delete', ['place' => $place->id]) }}" method="POST" style="display: none;">
                @csrf()
                @method('DELETE')
            </form>
        @endif
    </div>
</div>
