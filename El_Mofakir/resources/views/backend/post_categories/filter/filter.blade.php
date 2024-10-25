<div class="card-body">
    <form action="{{ route('admin.post_categories.index') }}" method="get">
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <label for="keyword">{{ __('Backend/post_categories.search') }}</label>
                    <input type="text" name="keyword" value="{{ old('keyword', request('keyword')) }}"
                           class="form-control" placeholder="{{ __('Backend/post_categories.search_here') }}">
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                        <label for="status">{{ __('Backend/posts.status') }}</label>
                    <select name="status" class="form-control">
                        <option value="">---</option>
                        <option
                            value="0" {{ old('status', request('status')) == '0' ? 'selected' : '' }}>{{ __('Backend/post_categories.inactive') }}</option>
                        <option
                            value="1" {{ old('status', request('status')) == '1' ? 'selected' : '' }}>{{ __('Backend/post_categories.active') }}</option>
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                        <label for="status">{{ __('Backend/posts.sort_by') }}</label>
                    <select name="sort_by" class="form-control">
                        <option value="">---</option>
                        <option
                            value="id" {{ old('sort_by',request('sort_by')) == 'id' ? 'selected' : '' }}>{{ __('Backend/post_categories.id') }}</option>
                        <option
                            value="name" {{ old('sort_by',request('sort_by')) == 'name' ? 'selected' : '' }}>{{ __('Backend/post_categories.name') }}</option>
                        <option
                            value="created_at" {{ old('sort_by',request('sort_by')) == 'created_at' ? 'selected' : '' }}>{{ __('Backend/post_categories.created_at') }}</option>
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                        <label for="status">{{ __('Backend/posts.order_by') }}</label>
                    <select name="order_by" class="form-control">
                        <option value="">---</option>
                        <option
                            value="asc" {{old('order_by',request('order_by'))  == 'asc' ? 'selected' : '' }}>{{ __('Backend/post_categories.asc') }}</option>
                        <option
                            value="desc" {{ old('order_by',request('order_by'))== 'desc' ? 'selected' : '' }}>{{ __('Backend/post_categories.desc') }}</option>
                    </select>
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                        <label for="status">{{ __('Backend/posts.limit_by') }}</label>
                    <select name="limit_by" class="form-control">
                        <option value="">---</option>
                        <option value="10" {{ old('limit_by',request('limit_by')) == '10' ? 'selected' : '' }}>10</option>
                        <option value="20" {{ old('limit_by',request('limit_by')) == '20' ? 'selected' : '' }}>20</option>
                        <option value="50" {{ old('limit_by',request('limit_by')) == '50' ? 'selected' : '' }}>50</option>
                        <option value="100" {{old('limit_by',request('limit_by')) == '100' ? 'selected' : '' }}>100</option>
                    </select>
                </div>
            </div>

            <div class="col-1">
                <div class="form-group">
                    <label for="">&nbsp;</label>
                    <label for="">&nbsp;</label>
                    <button type="submit" class="btn btn-link">{{ __('Backend/post_categories.search') }}</button>
                </div>
            </div>
        </div>
    </form>
</div>
