<div class="card-body">
    {!! Form::open(['route' => 'admin.pages.index', 'method'=> 'get']) !!}
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    {!! Form::text('keyword', old('keyword', request()->input('keyword')), ['class' => 'form-control', 'placeholder' => __('Backend/pages.search_here')]) !!}
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    {!! Form::select(__('Backend/pages.category'), [''=>'---' ] + $categories->toArray(),old('category_id', request()->input('category_id')), ['class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    {!! Form::select('status', ['' => '---', '1' => __('Backend/pages.read'), '0' => __('Backend/pages.new')], old('status', request()->input('status')), ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    {!! Form::select('sort_by', ['' => '---', 'name' => __('Backend/pages.name'), 'title' => __('Backend/pages.title'), 'created_at' => __('Backend/pages.created_at')], old('sort_by', request()->input('sort_by')), ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    {!! Form::select('order_by', ['' => '---', 'asc' => __('Backend/pages.asc'), 'desc' => __('Backend/pages.desc')], old('order_by', request()->input('order_by')), ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    {!! Form::select('limit_by', ['' => '---', '10' => '10', '20' => '20', '50' => '50', '100' => '100'], old('limit_by', request()->input('limit_by')), ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    {!! Form::button(__('Backend/pages.search'), ['class'=>'btn btn-link', 'type' => 'submit']) !!}
                </div>
            </div>
        </div>



    {!! Form::close() !!}


</div>
