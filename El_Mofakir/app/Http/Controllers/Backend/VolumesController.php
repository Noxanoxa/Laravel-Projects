<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Volume;
use App\Models\Issue;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class VolumesController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        if (!\auth()->user()->ability('admin', 'manage_volumes,show_volumes')) {
            return redirect('admin/index');
        }

        $volumes = Volume::withCount('posts')
                         ->withCount('issues')
                         ->when(request('keyword') != '', function ($query) {
                             $query->search(request('keyword'));
                         })
                         ->when(request('status') != '', function ($query) {
                             $query->whereStatus(request('status'));
                         })
                         ->orderBy(request('sort_by') ?? 'id', request('order_by') ?? 'desc')
                         ->paginate(request('limit_by') ?? '10')
                         ->withQueryString();

        return view('backend.volumes.index', compact('volumes'));
    }

    public function create()
    {
        if (!\auth()->user()->ability('admin', 'create_volumes')) {
            return redirect('admin/index');
        }
        return view('backend.volumes.create');
    }

    public function store(Request $request)
    {
        if (!\auth()->user()->ability('admin', 'create_volumes')) {
            return redirect('admin/index');
        }

        $validator = Validator::make($request->all(), [
            'number' => 'required',
            'year' => 'required',
            'status' => 'required',
            'issue_number' => 'required',
            'issue_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only(['number', 'year', 'status']);
        $volume = Volume::create($data);

        if ($request->status == 1) {
            Cache::forget('global_volumes');
        }

        // Create a new issue and associate selected posts
        $issueData = $request->only(['issue_number', 'issue_date']);
        $issue = $volume->issues()->create($issueData);

        if ($request->has('posts')) {
            $issue->posts()->sync($request->posts);
        }

        return redirect()->route('admin.volumes.index')->with([
            'message' => 'Volume created successfully',
            'alert-type' => 'success',
        ]);
    }

    public function show($id)
    {
        if (!\auth()->user()->ability('admin', 'display_volumes')) {
            return redirect('admin/index');
        }

        $volume = Volume::with(['issues.posts'])->findOrFail($id);
        return view('backend.volumes.show', compact('volume'));
    }

    public function edit($id)
    {
        if (!\auth()->user()->ability('admin', 'update_volumes')) {
            return redirect('admin/index');
        }

        $volume = Volume::findOrFail($id);
        $issues = Issue::whereVolumeId($id)->select('id', 'issue_number', 'issue_date')->get();
        return view('backend.volumes.edit', compact('volume',  'issues'));
    }

    public function update(Request $request, $id)
    {
        if (!\auth()->user()->ability('admin', 'update_volumes')) {
            return redirect('admin/index');
        }

        $validator = Validator::make($request->all(), [
            'number' => 'required',
            'year' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $volume = Volume::findOrFail($id);
        $data = $request->only(['number', 'year', 'status']);
        $volume->update($data);

        if ($request->status == 1) {
            Cache::forget('global_volumes');
        }

        return redirect()->route('admin.volumes.index')->with([
            'message' => 'Volume updated successfully',
            'alert-type' => 'success',
        ]);
    }

    public function destroy($id)
    {
        if (!\auth()->user()->ability('admin', 'delete_volumes')) {
            return redirect('admin/index');
        }

        $volume = Volume::findOrFail($id);
        $volume->delete();

        return redirect()->route('admin.volumes.index')->with([
            'message' => 'Volume deleted successfully',
            'alert-type' => 'success',
        ]);
    }
}
