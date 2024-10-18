<style>
    label {
        font-size: 14px; /* Adjust the size as needed */
    }
</style>
<div class="card-body">
    <form method="get" action="{{route('admin.posts.index')}}">
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <label for="keyword">{{ __('Backend/posts.search') }}</label>
                    <input type="text" name="keyword" value="{{old('keyword', request('keyword'))}}" class="form-control" placeholder="{{ __('Backend/posts.search_here')}}">
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="volume_id">{{ __('Backend/posts.volume') }}</label>
                    <select name="volume_id" id="volume_id" class="form-control">
                        <option value="">---</option>
                        @foreach($volumes as $volume)
                            <option value="{{$volume->id}}" {{ old('volume_id', request('volume_id')) == $volume->id ? 'selected' : '' }}>{{$volume->number}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="category_id">{{ __('Backend/posts.category') }}</label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option value="">---</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" {{ old('category_id', request('category_id')) == $category->id ? 'selected' : '' }}>{{$category->name()}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <label for="tag_id">{{ __('Backend/posts.tag') }}</label>
                    <select name="tag_id" id="tag_id" class="form-control">
                        <option value="">---</option>
                        @foreach($tags as $tag)
                            <option value="{{$tag->id}}" {{ old('tag_id', request('tag_id')) == $tag->id ? 'selected' : '' }}>{{$tag->name()}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <label for="status">{{ __('Backend/posts.status') }}</label>
                    <select name="status" id="status" class="form-control">
                        <option value="">---</option>
                        <option value="0" {{ old('status', request('status')) == '0' ? 'selected' : '' }}>{{__('Backend/posts.inactive')}}</option>
                        <option value="1" {{ old('status', request('status')) == '1' ? 'selected' : '' }}>{{__('Backend/posts.active')}}</option>
                    </select>
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <label for="sort_by">{{ __('Backend/posts.sort_by') }}</label>
                    <select name="sort_by" id="sort_by" class="form-control">
                        <option value="">---</option>
                        <option value="title" {{ old('sort_by', request('sort_by')) == 'title' ? 'selected' : '' }}>{{__('Backend/posts.title')}}</option>
                        <option value="created_at" {{ old('sort_by', request('sort_by')) == 'created_at' ? 'selected' : '' }}>{{__('Backend/posts.created_at')}}</option>
                    </select>
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <label for="order_by">{{ __('Backend/posts.order_by') }}</label>
                    <select name="order_by" id="order_by" class="form-control">
                        <option value="">---</option>
                        <option value="asc" {{ old('order_by', request('order_by')) == 'asc' ? 'selected' : '' }}>{{__('Backend/posts.asc')}}</option>
                        <option value="desc" {{ old('order_by', request('order_by')) == 'desc' ? 'selected' : '' }}>{{__('Backend/posts.desc')}}</option>
                    </select>
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <label for="limit_by">{{ __('Backend/posts.limit_by') }}</label>
                    <select name="limit_by" id="limit_by" class="form-control">
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
                    <button type="submit" class="btn btn-link">{{__('Backend/posts.search')}}</button>
                </div>
            </div>
        </div>
    </form>
</div>
