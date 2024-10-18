<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Issue;
use App\Models\Post;
use App\Models\Volume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IssuesController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        if (!\auth()->user()->ability('admin', 'manage_issues,show_issues')) {
            return redirect('admin/index');
        }

        $issues = Issue::with('posts')
                       ->when(request('keyword') != '', function ($query) {
                           $query->search(request('keyword'));
                       })
                       ->when(request('status') != '', function ($query) {
                           $query->whereStatus(request('status'));
                       })
                       ->orderBy(request('sort_by') ?? 'id', request('order_by') ?? 'desc')
                       ->paginate(request('limit_by') ?? '10')
                       ->withQueryString();

        return view('backend.issues.index', compact('issues'));
    }

    public function create()
    {
        if (!\auth()->user()->ability('admin', 'create_issues')) {
            return redirect('admin/index');
        }

        $volumes = Volume::select('id', 'number', 'year')->get();
        $posts = Post::post()->select('id', 'title', 'title_en', 'created_at')->get();

        return view('backend.issues.create', compact('volumes', 'posts'));
    }

    public function store(Request $request)
    {
        if (!\auth()->user()->ability('admin', 'create_issues')) {
            return redirect('admin/index');
        }

        $validator = Validator::make($request->all(), [
            'issue_number' => 'required',
            'issue_date' => 'required|date',
            'volume_id' => 'required|exists:volumes,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only(['issue_number', 'issue_date', 'volume_id']);
        Issue::create($data);

        return redirect()->route('admin.issues.index')->with([
            'message' => 'Issue created successfully',
            'alert-type' => 'success',
        ]);
    }

    public function show($id)
    {
        if (!\auth()->user()->ability('admin', 'display_issues')) {
            return redirect('admin/index');
        }

        $issue = Issue::with(['posts'])->findOrFail($id);
        return view('backend.issues.show', compact('issue'));
    }

    public function edit($id)
    {
        if (!\auth()->user()->ability('admin', 'update_issues')) {
            return redirect('admin/index');
        }

        $issue = Issue::findOrFail($id);
        $volume = Volume::where('id', '!=', $issue->volume_id)->select('id', 'number', 'year')->get();

        return view('backend.issues.edit', compact('issue', 'volume'));
    }

    public function update(Request $request, $id)
    {
        if (!\auth()->user()->ability('admin', 'update_issues')) {
            return redirect('admin/index');
        }

        $validator = Validator::make($request->all(), [
            'issue_number' => 'required',
            'issue_date' => 'required|date',
            'volume_id' => 'required|exists:volumes,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $issue = Issue::findOrFail($id);
        $data = $request->only(['issue_number', 'issue_date', 'volume_id']);
        $issue->update($data);

        return redirect()->route('admin.issues.index')->with([
            'message' => 'Issue updated successfully',
            'alert-type' => 'success',
        ]);
    }

    public function destroy($id)
    {
        if (!\auth()->user()->ability('admin', 'delete_issues')) {
            return redirect('admin/index');
        }

        $issue = Issue::findOrFail($id);
        $issue->delete();

        return redirect()->route('admin.issues.index')->with([
            'message' => 'Issue deleted successfully',
            'alert-type' => 'success',
        ]);
    }
}
