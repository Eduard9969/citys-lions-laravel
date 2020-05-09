@if(isset($place))
    <form action="{{ route('places.comments.store', ['place' => $place->id]) }}" method="POST">
        @csrf()

        <div class="form-group">
            <textarea
                required
                placeholder="Your comment"
                class="w-100 form-control"
                name="comment"
                id="comment"
                rows="5"
                style="min-height: 150px;max-height: 150px"></textarea>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-info text-white">{{ __('Leave Comment') }}</button>
        </div>
    </form>
@endif
