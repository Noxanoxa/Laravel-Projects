<div class="card-body">
    <form action="{{ route('admin.supervisors.index') }}" method="get">
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <input type="text" name="keyword" value="{{ old('keyword', request('keyword')) }}"
                           class="form-control" placeholder="{{ __('Backend/supervisors.search_here') }}">
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <select name="status" class="form-control">
                        <option value="">---</option>
                        <option
                            value="0" {{ old('status', request('status')) ==  '0' ? 'selected' : '' }}>{{ __('Backend/supervisors.inactive') }}</option>
                        <option
                            value="1" {{ old('status', request('status')) == '1' ? 'selected' : '' }}>{{ __('Backend/supervisors.active') }}</option>
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <select name="sort_by" class="form-control">
                        <option value="">---</option>
                        <option
                            value="id" {{ old('sort_by',request('sort_by')) == 'id' ? 'selected' : '' }}>{{ __('Backend/supervisors.id') }}</option>
                        <option
                            value="name" {{ old('sort_by',request('sort_by')) == 'name' ? 'selected' : '' }}>{{ __('Backend/supervisors.name') }}</option>
                        <option
                            value="created_at" {{ old('sort_by',request('sort_by')) == 'created_at' ? 'selected' : '' }}>{{ __('Backend/supervisors.created_at') }}</option>
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <select name="order_by" class="form-control">
                        <option value="">---</option>
                        <option
                            value="asc" {{old('order_by',request('order_by'))  == 'asc' ? 'selected' : '' }}>{{ __('Backend/supervisors.asc') }}</option>
                        <option
                            value="desc" {{ old('order_by',request('order_by'))== 'desc' ? 'selected' : '' }}>{{ __('Backend/supervisors.desc') }}</option>
                    </select>
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <select name="limit_by" class="form-control">
                        <option value="">---</option>
                        <option value="10" {{ old('limit_by',request('limit_by')) == '10' ? 'selected' : '' }}>10
                        </option>
                        <option value="20" {{ old('limit_by',request('limit_by')) == '20' ? 'selected' : '' }}>20
                        </option>
                        <option value="50" {{ old('limit_by',request('limit_by')) == '50' ? 'selected' : '' }}>50
                        </option>
                        <option value="100" {{old('limit_by',request('limit_by')) == '100' ? 'selected' : '' }}>100
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-2"></div>
            <div class="col-1">
                <div class="form-group">
                    <button type="submit" class="btn btn-link">{{ __('Backend/supervisors.search') }}</button>
                </div>
            </div>
        </div>
    </form>
</div>
