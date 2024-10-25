<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;

class AnnouncementsController extends Controller
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
        if (!\auth()->user()->ability('admin', 'manage_announcements,show_announcements')){
            return redirect('admin/index');
        }

        $announcements = Announcement::with([ 'user'])
                     ->when(request('keyword') != '', function ($query){
                         $query->search(request('keyword'));
                     })
                     ->when(request('status') != '', function ($query){
                         $query->whereStatus(request('status'));
                     })
                     ->orderBy(request('sort_by') ??  'id', request('order_by') ??  'desc')
                     ->paginate(request('limit_by')?? '10')
                     ->withQueryString();

        return view('backend.announcements.index', compact('announcements'));
    }

    public function create()
    {
        if (!\auth()->user()->ability('admin', 'create_announcements')){
            return redirect('admin/index');
        }
        return view('backend.announcements.create');

    }

    public function store(Request $request)
    {
        if (!\auth()->user()->ability('admin', 'create_announcements')){
            return redirect('admin/index');
        }
        $validator = Validator::make($request->all(), [
            'title'          => 'required',
            'title_en'          => 'required',
            'description'    => 'required|min:50',
            'description_en'    => 'required|min:50',
            'status'         => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data ['title']                   = $request->title;
        $data['title_en'] = $request->title_en;
        $data ['description']             = Purify::clean($request->description);
        $data['description_en'] = Purify::clean($request->description_en);
        $data ['status']                  = $request->status;


        $announcement = auth()->user()->announcements()->create($data);

        if($request->status == 1) {
            Cache::forget('recent_announcements');
        }

        return redirect()->route('admin.announcements.index')->with([
            'message' => __('messages.announcement_created_successfully'),
            'alert-type' => 'success',
        ]);
    }

    public function show($id)
    {
        if (!\auth()->user()->ability('admin', 'display_announcements')){
            return redirect('admin/index');
        }
        $announcement = Announcement::with([ 'user'])->whereId($id)->first();
        return view('backend.announcements.show', compact( 'announcement') );

    }

    public function edit($id)
    {
        if (!\auth()->user()->ability('admin', 'update_announcements')){
            return redirect('admin/index');
        }
        $announcement = Announcement::whereId($id)->first();
        return view('backend.announcements.edit', compact( 'announcement'));
    }


    public function update(Request $request, $id)
    {
        if (!\auth()->user()->ability('admin', 'update_announcements')){
            return redirect('admin/index');
        }
        $validator = Validator::make($request->all(), [
            'title'          => 'required',
            'title_en'          => 'required',
            'description'    => 'required|min:50',
            'description_en'    => 'required|min:50',
            'status'         => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $announcement = Announcement::whereId($id)->first();
        if($announcement) {
            $data ['title']                   = $request->title;
            $data['title_en'] = $request->title_en;
            $data ['slug']                   = null;
            $data ['slug_en']                   = null;
            $data ['description']             = Purify::clean($request->description);
            $data['description_en'] = Purify::clean($request->description_en);
            $data ['status']                  = $request->status;

            $announcement->update($data);


            return redirect()->route('admin.announcements.index')->with([
                'message' => __('messages.announcement_updated_successfully'),
                'alert-type' => 'success',
            ]);
        }
        return redirect()->route('admin.announcements.index')->with([
            'message' => __('messages.something_was_wrong'),
            'alert-type' => 'danger',
        ]);
    }

    public function destroy($id)
    {
        if (!\auth()->user()->ability('admin', 'delete_announcements')){
            return redirect('admin/index');
        }
        $announcement = Announcement::whereId($id)->first();
        if($announcement)
        {
            $announcement->delete();
            return  redirect()->route('admin.announcements.index')->with([
                'message' => __('messages.announcement_deleted_successfully'),
                'alert-type' => 'success',
            ]);
        }
        return redirect()->route('admin.announcements.index')->with([
            'message' => __('messages.something_was_wrong'),
            'alert-type' => 'danger',
        ]);


    }
}
