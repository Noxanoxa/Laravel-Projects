<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Category;
use App\Models\PostMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Stevebauman\Purify\Facades\Purify;
use ZipArchive;

class PagesController extends Controller
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
        if (!\auth()->user()->ability('admin', 'manage_pages,show_pages')){
            return redirect('admin/index');
        }


        $pages = Page::wherePostType('page')
            ->when(request('keyword') != '', function($q) {
                $q->search(request('keyword'));
            })
            ->when(request('category') != '', function($q) {
                $q->whereCategoryId(request('category'));
            })
            ->when(request('status') != '', function($q) {
                $q->whereStatus(request('status'));
            })
            ->orderBy(request('sort_by') ?? 'id', request('order_by') ?? 'desc')
            ->paginate(request('limit_by') ?? 10)
            ->withQueryString();


        $categories= Category::orderBy('id', 'desc')->select('id', 'name', 'name_en')->get();
        return view('backend.pages.index', compact('pages', 'categories'));
    }

    public function create()
    {
        if (!\auth()->user()->ability('admin', 'create_pages')){
            return redirect('admin/index');
        }
        $categories= Category::orderBy('id', 'desc')->select('id', 'name', 'name_en')->get();
        return view('backend.pages.create', compact('categories') );

    }

    public function store(Request $request)
    {
        if (!\auth()->user()->ability('admin', 'create_pages')){
            return redirect('admin/index');
        }
        $validator = Validator::make($request->all(), [
            'title'          => 'required',
            'title_en' => 'required',
            'description'    => 'required|min:50',
            'description_en' => 'required|min:50',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data ['title']                   = $request->title;
        $data ['title_en']                   = $request->title_en;
        $data ['description']             = Purify::clean($request->description);
        $data ['description_en']             = Purify::clean($request->description_en);
        $data ['status']                  = '1';
        $data ['post_type']                  = 'page';
        $data ['category_id']             = 'uncategorized';



        $page = auth()->user()->posts()->create($data);

        return redirect()->route('admin.pages.index')->with([
            'message' => __('messages.page_created_successfully'),
            'alert-type' => 'success',
        ]);
    }

    public function show($id)
    {
        if (!\auth()->user()->ability('admin', 'display_pages')){
            return redirect('admin/index');
        }
        $page = Page::whereId($id)->wherePostType('page')->first();
        return view('backend.pages.show', compact( 'page') );

    }

    public function edit($id)
    {
        if (!\auth()->user()->ability('admin', 'update_pages')){
            return redirect('admin/index');
        }
        $page = Page::whereId($id)->wherePostType('page')->first();
        return view('backend.pages.edit', compact( 'page') );

    }
    public function update(Request $request, $id)
    {
        if (!\auth()->user()->ability('admin', 'update_pages')){
            return redirect('admin/index');
        }
        $validator = Validator::make($request->all(), [
            'title'          => 'required',
            'title_en' => 'required',
            'description'    => 'required|min:50',
            'description_en' => 'required|min:50',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $page = Page::whereId($id)->wherePostType('page')->first();
        if($page) {
            $data ['title']                   = $request->title;
            $data ['title_en']                   = $request->title_en;
            $data ['slug']                   = null;
            $data ['slug_en']                   = null;
            $data ['description']             = Purify::clean($request->description);
            $data ['description_en']             = Purify::clean($request->description_en);
            $data ['status']                  = 1;
            $data ['category_id']             = 'uncategorized';

            $page->update($data);


            return redirect()->route('admin.pages.index')->with([
                'message' => __('messages.page_updated_successfully'),
                'alert-type' => 'success',
            ]);

            }
            return redirect()->route('admin.pages.index')->with([
                'message' => __('messages.something_was_wrong'),
                'alert-type' => 'danger',
            ]);

    }



}
