@if(!empty($sort))
    <form action="#" class="row">
        <div class="col-3">
            <label for="select-sort" class="d-flex align-items-center h-100 justify-content-end py-0 my-0">
                {{ __('Sort By') }}:
            </label>
        </div>

        <div class="col-9">
            <select class="form-control form-control-sm" name="order" onchange="if (this.value) window.location.href=this.value" id="select-sort">
                <option {{ !empty($sort) && $sort == 'created_at_desc' ? 'selected' : '' }}
                        value="{{ route('places.list', ['filter' => '', 'sort_by' => 'created_at_desc']) }}">
                    {{ __('Created At') }} - {{ __('Desc') }}
                </option>
                <option {{ !empty($sort) && $sort == 'created_at_asc' ? 'selected' : '' }}
                        value="{{ route('places.list', ['filter' => '', 'sort_by' => 'created_at_asc']) }}">
                    {{ __('Created At') }} - {{ __('Asc') }}
                </option>

                <option {{ !empty($sort) && $sort == 'name_desc' ? 'selected' : '' }}
                        value="{{ route('places.list', ['filter' => '', 'sort_by' => 'name_desc']) }}">
                    {{ __('Name') }} - {{ __('Desc') }}
                </option>
                <option {{ !empty($sort) && $sort == 'name_asc' ? 'selected' : '' }}
                        value="{{ route('places.list', ['filter' => '', 'sort_by' => 'name_asc']) }}">
                    {{ __('Name') }} - {{ __('Asc') }}
                </option>
            </select>
        </div>
    </form>
@endif
