<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;


class ContactUsController extends Controller
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
        if (!\auth()->user()->ability('admin', 'manage_contact_us,show_contact_us')){
            return redirect('admin/index');
        }

        $messages = Contact::query()
        ->when(request('keyword') != '', function ($query){
        $query->search(request('keyword'));
    })
        ->when(request('status') != '', function ($query){
            $query->whereStatus(request('status'));
        })
        ->orderBy(request('sort_by') ??  'id', request('order_by') ??  'desc')
        ->paginate(request('limit_by')?? '10')
        ->withQueryString();

        return view('backend.contact_us.index', compact('messages'));
    }



    public function show($id)
    {
        if (!\auth()->user()->ability('admin', 'display_contact_us')){
            return redirect('admin/index');
        }
        $message = Contact::whereId($id)->first();
        if($message && $message->status == 0){
/*            $message->update([
                'status' => 1
            ]);*/
            $message->status = 1;
            $message->save();
        }
        return view('backend.contact_us.show', compact( 'message') );

    }


    public function destroy($id)
    {
        if (!\auth()->user()->ability('admin', 'delete_contact_us')){
            return redirect('admin/index');
        }
         $message = Contact::whereId($id)->first();
        if($message)
        {

            $message->delete();

            return  redirect()->route('admin.contact_us.index')->with([
                'message' => 'Message Deleted Successfully',
                'alert-type' => 'success',
            ]);
        }
        return redirect()->route('admin.contact_us.index')->with([
            'message' => 'Something was wrong. Message Not Found',
            'alert-type' => 'danger',
        ]);


    }

}
