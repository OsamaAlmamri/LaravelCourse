<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\GeneralNotification;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class FireBaseController extends Controller
{

    // fcm_token , topic ,
    public static function subscribeToTopic($registrationTokenOrTokens)
    {
        $factory = (new Factory)->withServiceAccount(__DIR__ . '/laravel10-firebaseConfig.json');
        $messaging = $factory->createMessaging();
        $topic = 'a-topic';
        $result = $messaging->subscribeToTopic($topic, $registrationTokenOrTokens);
    }

    public static function index($customNotification)
    {

        $factory = (new Factory)->withServiceAccount(__DIR__ . '/laravel10-firebaseConfig.json');
        $messaging = $factory->createMessaging();
        $topic = 'a-topic';
        $notification = [
            'title' => $customNotification->title,
            'body' => $customNotification->description,
            'image' => url('storage/'.$customNotification->image ),
            'icon' => "https://hayat.erum.ae/storage/uploads/website/logo2.png",
            'color' => '#f45342',
            'sound' => 'default'
        ];
        $data = ['ddd' => 'd'];

        $message = CloudMessage::withTarget('topic', $topic)
            ->withWebPushConfig([
                'headers' => [
                    'Urgency' => 'normal',
                ],
                'notification' => $notification,
                'fcm_options' => [
                    // https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#fcmoptions
                    'analytics_label' => 'some-analytics-label',
                    "link" => url('')
                ]
            ])
            ->withNotification($notification) // optional
            ->withData($data) // optional
        ;


        $messaging->send($message);
    }

    public static function sendOneUser($notification, $deviceToken, $link, $user = null)
    {
        $notification = [
            'title' => $notification->title,
            'body' => $notification->description,
            'image2' => $notification->image ,
            'image' => url('storage/'.$notification->image ),
         //   'icon' => "https://hayat.erum.ae/storage/uploads/website/logo2.png",
            'color' => '#f45342',
            'sound' => 'default'
        ];

        if ($user != null) {
            $user->notify(new GeneralNotification([
                'user_id' => $user->id,
                'content' => $notification['title']. $notification['body'],
                'image' => $notification['image2'],
                'action_url' => $link,
                'methods' => ['database'],
                'btn_text' => "عرض "
            ]));

        }
        if ($deviceToken != null) {
            $factory = (new Factory)
                ->withServiceAccount(__DIR__ . '/laravel10-firebaseConfig.json');
            $messaging = $factory->createMessaging();
            $message = CloudMessage::withTarget('token', $deviceToken)
                ->withWebPushConfig([

                    'notification' => $notification,
                    'fcm_options' => [
                        "link" => $link
                    ]
                ])
                ->withNotification($notification);
            $messaging->send($message);
            return ($messaging);
        }
    }

    public static function sendAllUsers($customNotification, $link = null)
    {
        if ($link == null)
            $link = url('');
        $deviceTokens = User::whereNotNull('fcm_token')
            ->get()->pluck('fcm_token')->toArray();
        $factory = (new Factory)->withServiceAccount(__DIR__ . '/laravel10-firebaseConfig.json');
        $messaging = $factory->createMessaging();
        $notification = Notification::fromArray([
            'title' => $customNotification->title,
            'body' => $customNotification->description,
            'image' => $customNotification->image == "" ? null : $customNotification->image()
        ]);

        $message = CloudMessage::new()->withNotification($notification) // optional
        ->withWebPushConfig([
            'notification' => $notification,
            'fcm_options' => [
                "link" => $link
            ]
        ])->withData($customNotification);
        if (count($deviceTokens) > 0) {
            $sendReport = $messaging->sendMulticast($message, $deviceTokens);
            return $sendReport;
        }
    }

}
