<div class="card-body">
    <form method="get" action="{{route('admin.professionals.index')}}">
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <input type="text" name="keyword" value="{{ old('keyword', request('keyword')) }}" class="form-control" placeholder="{{ __('Backend/professionals.search_here') }}">
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <select name="status" class="form-control">
                        <option value="">---</option>
                        <option value="0" {{ old('status', request()->input('status')) == '0' ? 'selected' : '' }}>{{ __('Backend/professionals.national') }}</option>
                        <option value="1" {{ old('status', request()->input('status')) == '1' ? 'selected' : '' }}>{{ __('Backend/professionals.international') }}</option>
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <select name="sort_by" class="form-control">
                        <option value="">---</option>
                        <option value="name" {{ old('sort_by', request()->input('sort_by')) == 'name' ? 'selected' : '' }}>{{ __('Backend/professionals.name') }}</option>
                        <option value="id" {{ old('sort_by', request()->input('sort_by')) == 'id' ? 'selected' : '' }}>{{ __('Backend/professionals.id') }}</option>
                        <option value="created_at" {{ old('sort_by', request()->input('sort_by')) == 'created_at' ? 'selected' : '' }}>{{ __('Backend/professionals.created_at') }}</option>
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <select name="order_by" class="form-control">
                        <option value="">---</option>
                        <option value="asc" {{ old('order_by', request()->input('order_by')) == 'asc' ? 'selected' : '' }}>{{ __('Backend/professionals.asc') }}</option>
                        <option value="desc" {{ old('order_by', request()->input('order_by')) == 'desc' ? 'selected' : '' }}>{{ __('Backend/professionals.desc') }}</option>
                    </select>
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <select name="limit_by" class="form-control">
                        <option value="">---</option>
                        <option value="10" {{ old('limit_by', request()->input('limit_by')) == 10 ? 'selected' : '' }}>10</option>
                        <option value="20" {{ old('limit_by', request()->input('limit_by')) == 20 ? 'selected' : '' }}>20</option>
                        <option value="50" {{ old('limit_by', request()->input('limit_by')) == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ old('limit_by', request()->input('limit_by')) == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </div>
            </div>
            <div class="col-2"></div>
            <div class="col-1">
                <div class="form-group">
                    <button type="submit" class="btn btn-link">{{ __('Backend/professionals.search') }}</button>
                </div>
            </div>
        </div>
    </form>
</div>
