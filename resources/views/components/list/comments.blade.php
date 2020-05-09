<div class="row">
    @foreach($comments as $comment)
        <div class="col-12 mb-3">
            @include('components.items.comment')
        </div>
    @endforeach
</div>
