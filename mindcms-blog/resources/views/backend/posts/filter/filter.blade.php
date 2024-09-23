<div class="card-body">
    {!! Form::open(['route' => 'admin.posts.index', 'method'=> 'get']) !!}
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    {!! Form::text('keyword', old('keyword', request()->input('keyword')), ['class'=>'form-control', 'placeholder' => 'Search here']) !!}
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    {!! Form::select('category_id', [''=>'---' ] + $categories->toArray(),old('category_id', request()->input('category_id')), ['class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    {!! Form::select('tag_id', [''=>'---' ] + $tags->toArray(),old('tag_id', request()->input('tag_id')), ['class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    {!! Form::select('status', ['' => '---' , '0' => __('Backend/posts.inactive'), '1' => __('Backend/posts.active') ],old('status', request()->input('status')), ['class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    {!! Form::select('sort_by', ['' => '---' , 'title' => __('Backend/posts.title'), 'created_at' => __('Backend/posts.created_at') ],old('sort_by', request()->input('sort_by')), ['class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    {!! Form::select('order_by', ['' => '---', 'asc' => __('Backend/posts.asc'), 'desc' => __('Backend/posts.desc')], old('order_by', request()->input('order_by')), ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    {!! Form::select('limit_by', ['' => '---' , '10' => '10', '20' => '20', '50' => '50', '100' => '100' ],old('limit_by', request()->input('limit_by')), ['class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    {!! Form::button('Search', ['class'=>'btn btn-link', 'type' => 'submit']) !!}
                </div>
            </div>
        </div>



    {!! Form::close() !!}


</div>
