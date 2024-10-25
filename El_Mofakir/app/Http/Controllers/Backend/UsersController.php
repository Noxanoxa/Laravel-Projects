<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;

use App\Models\UserMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class UsersController extends Controller
{

    public function __construct()
    {
        if (\auth()->check()) {
            $this->middleware('auth');
        } else {
            return view('backend.auth.login');
        }
    }

    public function index()
    {
        if ( ! \auth()->user()->ability('admin', 'manage_users,show_users')) {
            return redirect('admin/index');
        }

        $users = User::query()
                     ->whereRelation('roles', 'name', 'user')
                     ->when(request('keyword') != '', function ($query) {
                         $query->search(request('keyword'));
                     })
                     ->when(request('status') != '', function ($query) {
                         $query->whereStatus(request('status'));
                     })
                     ->orderBy(
                         request('sort_by') ?? 'id',
                         request('order_by') ?? 'desc'
                     )
                     ->paginate(request('limit_by') ?? '10')
                     ->withQueryString();

        return view('backend.users.index', compact('users'));
    }

    public function create()
    {
        if ( ! \auth()->user()->ability('admin', 'create_users')) {
            return redirect('admin/index');
        }

        return view('backend.users.create');
    }

    public function store(Request $request)
    {
        if ( ! \auth()->user()->ability('admin', 'create_users')) {
            return redirect('admin/index');
        }
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'username' => 'required|max:20|unique:users',
            'email'    => 'required|email|max:255|unique:users',
            'mobile'   => 'required|numeric|unique:users',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data ['name']     = $request->name;
        $data ['username'] = $request->username;
        $data ['email']    = $request->email;
        $data ['mobile']   = $request->mobile;
        $data ['password'] = bcrypt('123123123');

        if ($user_image = $request->file('user_image')) {
            $filename = Str::slug($request->username) . '.'
                        . $user_image->getClientOriginalExtension();

            $path = public_path('assets/users/' . $filename);
            Image::make($user_image->getRealPath())->resize(
                300,
                300,
                function ($constraint) {
                    $constraint->aspectRatio();
                }
            )->save($path, 100);
            $data['user_image'] = $filename;
        }
        $user = User::create($data);

        if ($request->hasFile('pdf')) {
            $file      = $request->file('pdf');
            $filename  = $user->name . '-' . time() . '-' . uniqid() . '.'
                         . $file->getClientOriginalExtension();
            $file_size = $file->getSize();
            $file_type = $file->getMimeType();
            $file->move(public_path('assets/users'), $filename);

            $user->media()->create([
                'user_id'        => $user->id,
                'file_name'      => $filename,
                'real_file_name' => $file->getClientOriginalName(),
                'file_size'      => $file_size,
                'file_type'      => $file_type,
            ]);
        }

        $user->attachRole(Role::whereName('user')->first()->id);

        return redirect()->route('admin.users.index')->with([
            'message'    => __('messages.user_created_successfully'),
            'alert-type' => 'success',
        ]);
    }

    public function show($id)
    {
        if ( ! \auth()->user()->ability('admin', 'display_users')) {
            return redirect('admin/index');
        }

        $user = User::whereId($id)->withCount('posts')->first();
        if ($user) {
            return view('backend.users.show', compact('user'));
        }

        return redirect()->route('admin.users.index')->with([
            'message'    => __('messages.something_was_wrong'),
            'alert-type' => 'danger',
        ]);
    }

    public function edit($id)
    {
        if ( ! \auth()->user()->ability('admin', 'update_users')) {
            return redirect('admin/index');
        }
        $user = User::with('media')->whereId($id)->first();
        if ($user) {
            return view('backend.users.edit', compact('user'));
        }

        return redirect()->route('admin.users.index')->with([
            'message'    => __('messages.something_was_wrong'),
            'alert-type' => 'danger',
        ]);
    }

    public function update(Request $request, $id)
    {
        if ( ! \auth()->user()->ability('admin', 'update_users')) {
            return redirect('admin/index');
        }
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'username' => 'required|max:20|unique:users,username,' . $id,
            'email'    => 'required|email|max:255|unique:users,email,' . $id,
            'mobile'   => 'required|numeric|unique:users,mobile,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::whereId($id)->first();
        if ($user) {
            $data ['name']     = $request->name;
            $data ['username'] = $request->username;
            $data ['email']    = $request->email;
            $data ['mobile']   = $request->mobile;
            $data ['password'] = bcrypt('123123123');

            if ($request->hasFile('pdf')) {
                $file      = $request->file('pdf');
                $filename  = $user->name . '-' . time() . '-' . uniqid() . '.'
                             . $file->getClientOriginalExtension();
                $file_size = $file->getSize();
                $file_type = $file->getMimeType();
                $file->move(public_path('assets/users'), $filename);

                $user->media()->create([
                    'file_name'      => $filename,
                    'real_file_name' => $file->getClientOriginalName(),
                    'file_type'      => $file_type,
                    'file_size'      => $file_size,
                ]);
            }

            if ($user_image = $request->file('user_image')) {
                if ($user->user_image != '') {
                    if (File::exists('assets/users/' . $user->user_image)) {
                        unlink('assets/users/' . $user->user_image);
                    }
                }
                $filename = Str::slug($request->username) . '.'
                            . $user_image->getClientOriginalExtension();
                $path     = public_path('assets/users/' . $filename);
                Image::make($user_image->getRealPath())->resize(
                    300,
                    300,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save($path, 100);
                $data['user_image'] = $filename;
            }

            $user->update($data);

            return redirect()->route('admin.users.index')->with([
                'message'    => __('messages.user_updated_successfully'),
                'alert-type' => 'success',
            ]);
        }

        return redirect()->route('admin.users.index')->with([
            'message'    => __('messages.something_was_wrong'),
            'alert-type' => 'danger',
        ]);
    }

    public function destroy($id)
    {
        if ( ! \auth()->user()->ability('admin', 'delete_users')) {
            return redirect('admin/index');
        }
        $user = User::whereId($id)->first();
        if ($user) {
            if ($user->user_image != '') {
                if (File::exists('assets/users/' . $user->user_image)) {
                    unlink('assets/users/' . $user->user_image);
                }
            }
            $user->delete();

            return redirect()->route('admin.users.index')->with([
                'message'    => __('messages.user_deleted_successfully'),
                'alert-type' => 'success',
            ]);
        }

        return redirect()->route('admin.users.index')->with([
            'message'    => __('messages.something_was_wrong'),
            'alert-type' => 'danger',
        ]);
    }

    public function removePdf(Request $request)
    {
        if ( ! \auth()->user()->ability('admin', 'delete_posts')) {
            return redirect('admin/index');
        }
        $media = UserMedia::whereId($request->media_id)->first();
        if ($media) {
            if (File::exists('assets/users/' . $media->file_name)) {
                unlink('assets/users/' . $media->file_name);
            }
            $media->delete();

            return true;
        }

        return false;
    }

    public function downloadCv($id)
    {
        $user  = User::findOrFail($id);
        $media = $user->media->where('file_type', 'application/pdf')->first();

        if ($media) {
            $filePath = public_path('assets/users/' . $media->file_name);

            return response()->download($filePath, $media->real_file_name);
        }

        return redirect()->back()->with('error', 'No CV found for this user.');
    }

    public function removeImage(Request $request)
    {
        if ( ! \auth()->user()->ability('admin', 'delete_users')) {
            return redirect('admin/index');
        }
        $user = User::whereId($request->user_id)->first();
        if ($user) {
            if (File::exists('assets/users/' . $user->user_image)) {
                unlink('assets/users/' . $user->user_image);
            }
            $user->user_image = null;
            $user->save();

            return 'true';
        }

        return 'false';
    }

}
