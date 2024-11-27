<?php


namespace App\Modules\Auth\Notification\Actions;

use App\Modules\Auth\Notification\DTO\NotificationDTO;
use App\Modules\Auth\Notification\Models\Notification;
use App\Modules\Auth\Responsible\Models\Responsible;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class StoreNotificationAction
{

    public static function execute(NotificationDTO $notificationDTO)
    {
        $notification = new Notification($notificationDTO->toArray());
        Http::withHeaders([
            'Authorization' => "key=BKYjY-SeKxZzBzNcbnwT3AIIF7A5zDZc278JLJJMnDUmJwbbKoRhjA9Kkt-Z_N7dR4l3-hKhv_R3Vlex7Kw7tEI",
            "Content-Type" => "application/json"
        ])->post('https://fcm.googleapis.com/fcm/send', [
            "registration_ids" => $notificationDTO->users,
            "notification" => [
                "title" => $notificationDTO->title,
                "body" => $notificationDTO->body
            ]
        ]);
//    if (isset(Auth::guard('web')->id)) {
//      $notification->created_by_id = Auth::guard('web')->id;
//    }
//    $notification->save();
//    $responsibles = Responsible::whereIn('fcm_token', $notificationDTO->responsibles)->get()->pluck('id');
//    $notification->responsibles()->sync($responsibles);
        return $notification;
    }
}
