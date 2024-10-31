<div class="card-body">
    <form action="{{ route('admin.issues.index') }}" method="get">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="keyword">{{ __('Backend/issues.keyword') }}</label>
                    <input type="text" name="keyword" value="{{ old('keyword', request('keyword')) }}"
                           class="form-control" placeholder="{{ __('Backend/issues.search_here') }}">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="sort_by">{{ __('Backend/issues.status') }}</label>
                    <select name="status" class="form-control">
                        <option value="">---</option>
                        <option
                            value="0" {{ old('status', request('status')) == '0' ? 'selected' : '' }}>{{ __('Backend/issues.inactive') }}</option>
                        <option
                            value="1" {{ old('status', request('status')) == '1' ? 'selected' : '' }}>{{ __('Backend/issues.active') }}</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="sort_by">{{ __('Backend/issues.sort_by') }}</label>
                    <select name="sort_by" class="form-control">
                        <option value="">---</option>
                        <option
                            value="id" {{ old('sort_by',request('sort_by')) == 'id' ? 'selected' : '' }}>{{ __('Backend/issues.id') }}</option>
                        <option
                            value="created_at" {{ old('sort_by',request('sort_by')) == 'created_at' ? 'selected' : '' }}>{{ __('Backend/issues.created_at') }}</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="keyword">{{ __('Backend/issues.order_by') }}</label>
                    <select name="order_by" class="form-control">
                        <option value="">---</option>
                        <option
                            value="asc" {{old('order_by',request('order_by'))  == 'asc' ? 'selected' : '' }}>{{ __('Backend/issues.asc') }}</option>
                        <option
                            value="desc" {{ old('order_by',request('order_by'))== 'desc' ? 'selected' : '' }}>{{ __('Backend/issues.desc') }}</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="limit_by">{{ __('Backend/issues.limit_by') }}</label>
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
                    <button type="submit" class="btn btn-link">{{ __('Backend/issues.search') }}</button>
                </div>
            </div>
        </div>
    </form>
</div>
