<div class="card-body">
    <form  method="get" action="{{ route('admin.pages.index') }}">
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <input type="text" name="keyword" class="form-control" placeholder="{{__('Backend/pages.search_here')}}" value="{{old('keyword', request()->input('keyword'))}}">
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <select name="category_id" class="form-control">
                        <option value="">---</option>
                        @foreach($categories as $key => $category)
                            <option value="{{ $key }}"> {{ $category }} </option>
                        @endforeach
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <select name="status" class="form-control">
                        <option value="">---</option>
                        <option value="1"> {{__('Backend/pages.read')}} </option>
                        <option value="0"> {{__('Backend/pages.new')}} </option>
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <select name="sort_by" class="form-control">
                        <option value="">---</option>
                        <option value="name"> {{__('Backend/pages.name')}} </option>
                        <option value="title"> {{__('Backend/pages.title')}} </option>
                        <option value="created_at"> {{__('Backend/pages.created_at')}} </option>
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <select name="order_by" class="form-control">
                        <option value="">---</option>
                        <option value="asc"> {{__('Backend/pages.asc')}} </option>
                        <option value="desc"> {{__('Backend/pages.desc')}} </option>
                    </select>
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <select name="limit_by" class="form-control">
                        <option value="">---</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{__('Backend/pages.search')}}</button>
                </div>
            </div>
        </div>
    </form>
</div>
