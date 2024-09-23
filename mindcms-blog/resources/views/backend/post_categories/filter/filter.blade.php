<div class="card-body">
    {!! Form::open(['route' => 'admin.post_categories.index', 'method'=> 'get']) !!}
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    {!! Form::text('keyword', old('keyword', request()->input('keyword')), ['class'=>'form-control', 'placeholder' => __('Backend/post_categories.search_here')]) !!}
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    {!! Form::select('status', ['' => '---' , '0' => __('Backend/post_categories.inactive'), '1' => __('Backend/post_categories.active') ],old('status', request()->input('status')), ['class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    {!! Form::select('sort_by', ['' => '---' , 'id' => __('Backend/post_categories.id'), 'name' => __('Backend/post_categories.name'), 'created_at' => __('Backend/post_categories.created_at') ],old('sort_by', request()->input('sort_by')), ['class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    {!! Form::select('order_by', ['' => '---', 'asc' => __('Backend/post_categories.asc'), 'desc' => __('Backend/post_categories.desc')], old('order_by', request()->input('order_by')), ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    {!! Form::select('limit_by', ['' => '---' , '10' => '10', '20' => '20', '50' => '50', '100' => '100' ],old('limit_by', request()->input('limit_by')), ['class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-2"></div>
            <div class="col-1">
                <div class="form-group">
                    {!! Form::button(__('Backend/post_categories.search'), ['class'=>'btn btn-link', 'type' => 'submit']) !!}
                </div>
            </div>
        </div>
    {!! Form::close() !!}
</div>
