<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostCategoriesController extends Controller
{
    public function __construct() {
        if(\auth()->check()){
            $this->middleware('auth');
        }
        else {
            return view('backend.auth.login');
        }
    }

    public function index()
    {
        if (!\auth()->user()->ability('admin', 'manage_post_categories,show_post_categories')){
            return redirect('admin/index');
        }

        $categories = Category::withCount('posts' )
                     ->when(request('keyword') != '', function ($query){
                         $query->search(request('keyword'));
                     })
                     ->when(request('status') != '', function ($query){
                         $query->whereStatus(request('status'));
                     })
                     ->orderBy(request('sort_by') ??  'id', request('order_by') ??  'desc')
                     ->paginate(request('limit_by')?? '10')
                     ->withQueryString();

        return view('backend.post_categories.index', compact( 'categories'));
    }

    public function create()
    {
        if (!\auth()->user()->ability('admin', 'create_post_categories')){
            return redirect('admin/index');
        }
        return view('backend.post_categories.create');

    }

    public function store(Request $request)
    {
        if (!\auth()->user()->ability('admin', 'create_post_categories')) {
            return redirect('admin/index');
        }

        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'name_en'       => 'required',
            'status'        => 'required',
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['name']              = $request->name;
        $data['name_en']           = $request->name_en;
        $data['status']             = $request->status;

        Category::create($data);

        if ($request->status == 1) {
            Cache::forget('global_categories');
        }

        return redirect()->route('admin.post_categories.index')->with([
            'message' => 'Category created successfully',
            'alert-type' => 'success',
        ]);
    }

    public function show($id)
    {
/*        if (!\auth()->user()->ability('admin', 'display_post')){
            return redirect('admin/index');
        }*/

    }

    public function edit($id)
    {
        if (!\auth()->user()->ability('admin', 'update_post_categories')){
            return redirect('admin/index');
        }
        $category= Category::whereId($id)->first();
        return view('backend.post_categories.edit', compact('category') );

    }

    public function update(Request $request, $id)
    {
        if (!\auth()->user()->ability('admin', 'update_post_categories')){
            return redirect('admin/index');
        }
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'name_en'       => 'required',
            'status'         => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category = Category::whereId($id)->first();
        if($category) {
            $data ['name']   = $request->name;
            $data ['name_en'] = $request->name_en;
            $data['slug']    = null;
            $data['slug_en']    = null;
            $data ['status'] = $request->status;

            $category->update($data);
            Cache::forget('global_categories');

            return redirect()->route('admin.post_categories.index')->with([
                'message'    => 'Category Updated Successfully',
                'alert-type' => 'success',
            ]);
        }
            return redirect()->route('admin.post_categories.index')->with([
                'message' => 'Something was wrong please try again later',
                'alert-type' => 'danger',
            ]);

    }

    public function destroy($id)
    {
        if (!\auth()->user()->ability('admin', 'delete_post_categories')){
            return redirect('admin/index');
        }
        $category = Category::whereId($id)->first();
        foreach ($category->posts as $post) {
                if($post->media->count() > 0) {
                    foreach ($post->media as $media) {
                        if(File::exists('assets/posts/' . $media->file_name)) {
                            unlink('assets/posts/' . $media->file_name);
                        }
                    }
                }
        }
        $category->delete();
        return  redirect()->route('admin.post_categories.index')->with([
                'message' => 'Category Deleted Successfully',
                'alert-type' => 'success',
            ]);

    }
}
