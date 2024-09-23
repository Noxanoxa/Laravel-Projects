<div class="card-body">
    {!! Form::open(['route' => 'admin.post_tags.index', 'method'=> 'get']) !!}
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    {!! Form::text('keyword', old('keyword', request()->input('keyword')), ['class'=>'form-control', 'placeholder' => __('Backend/post_comments.search_here')]) !!}
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    {!! Form::select('sort_by', ['' => '---' , 'id' => __('Backend/post_tags.id'), 'name' => __('Backend/post_tags.name'), 'created_at' => __('Backend/post_tags.created_at') ],old('sort_by', request()->input('sort_by')), ['class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    {!! Form::select('order_by', ['' => '---', 'asc' => __('Backend/post_tags.asc'), 'desc' => __('Backend/post_tags.desc')], old('order_by', request()->input('order_by')), ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    {!! Form::select('limit_by', ['' => '---' , '10' => '10', '20' => '20', '50' => '50', '100' => '100' ],old('limit_by', request()->input('limit_by')), ['class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-4"></div>
            <div class="col-1">
                <div class="form-group">
                    {!! Form::button(__('Backend/post_tags.search'), ['class'=>'btn btn-link', 'type' => 'submit']) !!}
                </div>
            </div>
        </div>



    {!! Form::close() !!}


</div>
