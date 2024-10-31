<!-- Define the CSS class to decrease the font size -->
<div class="card-body">
    <form method="get" action="{{route('admin.announcements.index')}}">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="keyword">{{ __('Backend/announcements.keyword') }}</label>
                    <input type="text" name="keyword" value="{{old('keyword', request('keyword'))}}" class="form-control" placeholder="{{ __('Backend/announcements.search_here')}}">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="sort_by">{{ __('Backend/announcements.status') }}</label>
                    <select name="status" class="form-control">
                        <option value="">---</option>
                        <option value="0" {{ old('status', request('status')) == '0' ? 'selected' : '' }}>{{__('Backend/announcements.inactive')}}</option>
                        <option value="1" {{ old('status', request('status')) == '1' ? 'selected' : '' }}>{{__('Backend/announcements.active')}}</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="sort_by">{{ __('Backend/announcements.sort_by') }}</label>
                    <select name="sort_by" class="form-control">
                        <option value="">---</option>
                        <option value="title" {{ old('sort_by', request('sort_by')) == 'title' ? 'selected' : '' }}>{{__('Backend/announcements.title')}}</option>
                        <option value="created_at" {{ old('sort_by', request('sort_by')) == 'created_at' ? 'selected' : '' }}>{{__('Backend/announcements.created_at')}}</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="keyword">{{ __('Backend/announcements.order_by') }}</label>
                    <select name="order_by" class="form-control">
                        <option value="">---</option>
                        <option value="asc" {{ old('order_by', request('order_by')) == 'asc' ? 'selected' : '' }}>{{__('Backend/announcements.asc')}}</option>
                        <option value="desc" {{ old('order_by', request('order_by')) == 'desc' ? 'selected' : '' }}>{{__('Backend/announcements.desc')}}</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="limit_by">{{ __('Backend/announcements.limit_by') }}</label>
                    <select name="limit_by" class="form-control">
                        <option value="">---</option>
                        <option value="10" {{ old('limit_by', request('limit_by')) == '10' ? 'selected' : '' }}>10</option>
                        <option value="20" {{ old('limit_by', request('limit_by')) == '20' ? 'selected' : '' }}>20</option>
                        <option value="50" {{ old('limit_by', request('limit_by')) == '50' ? 'selected' : '' }}>50</option>
                        <option value="100" {{ old('limit_by', request('limit_by')) == '100' ? 'selected' : '' }}>100</option>
                    </select>
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <label for="">&nbsp;</label>
                    <label for="">&nbsp;</label>
                    <button type="submit" class="btn btn-link">{{__('Backend/announcements.search')}}</button>
                </div>
            </div>
        </div>
</form>
</div>
