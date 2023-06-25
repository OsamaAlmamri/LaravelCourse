<?php

namespace App\Http\Controllers;

use App\Models\CustomNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomNotificationController extends Controller
{


    public function index(Request $request)
    {
        $notifications = CustomNotification::orderBy('id', 'DESC')
            ->paginate(25);



        return view("custom-notifications.index", compact('notifications'));
    }

    public function create()
    {
        return view("custom-notifications.create")
            ->with('type', 'create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'title' => "required",
        ]);
        $path = '';
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('customNotifications');
        }
        $customNotification = CustomNotification::create([
            "title" => $request->title,
            "description" => $request->description,
            "target" => $request->target,
            "image" => $path,
            "user_id" => auth()->id(),
            "basic_type" => $request->basic_type,
        ]);
      $this->send($customNotification);
        $user=User::find(1);
       // FireBaseController::sendOneUser($customNotification,$user->fcm_token,route('products.index'),$user);
        toastr()->success("notification send successfully");
        return redirect()->route('custom-notifications.index');
    }

    public function send($customNotification)
    {
        if ($customNotification->target == "all") {
            FireBaseController::index($customNotification);
        } else
            FireBaseController::sendAllUsers($customNotification);


    }



    public function edit(CustomNotification $customNotification)
    {
        return view("custom-notifications.create", compact('customNotification'))->with('type', 'edit');
    }

    public function update(Request $request, CustomNotification $customNotification)
    {
        $request->validate([

            'title' => "required",
        ]);


        $path = $customNotification->image;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('customNotifications');
        }
        $customNotification->update([
            "title" => $request->title,
            "description" => $request->description,
            "target" => $request->target,
            "image" => $path,
            "user_id" => auth()->id(),
            "basic_type" => $request->basic_type,
        ]);

        $this->send($customNotification);
        toastr()->success("notification send successfully");
        return redirect()->route('custom-notifications.index');
    }

    public function resend($id)
    {
        $customNotification = CustomNotification::find($id);
        $this->send($customNotification);
        return redirect()->route('custom-notifications.index');
    }

    public function destroy(CustomNotification $customNotification)
    {
        $customNotification->delete();
        toastr()->success("notification deleted successfully");
        return redirect()->route('custom-notifications.index');
    }


    public function fcm_token(Request $request)
    {


        if(auth()->user()!=null)
        {
            auth()->user()->update(['fcm_token'=>$request->token]);
        }
        FireBaseController::subscribeToTopic($request->token);
        return $request->token;



    }
}
