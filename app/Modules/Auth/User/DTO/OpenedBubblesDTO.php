<?php


namespace App\Modules\Auth\User\DTO;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\DataTransferObject\DataTransferObject;


class OpenedBubblesDTO extends DataTransferObject
{

    /** @var int $from_user_id */
    public $from_user_id;

    /** @var int $to_user_id */
    public $to_user_id;



    public static function fromRequest($request)
    {
        return new self([
            'from_user_id' => Auth::id(),
            'to_user_id' => $request['to_user_id'],

        ]);
    }

    public static function fromRequestForUpdate($request, $user)
    {
        return new self([
            'name' => isset($request['name']) ? $request['name'] : $user->name,
            'email' => isset($request['email']) ? $request['email'] : $user->email,
            'phone' => isset($request['phone']) ? $request['phone'] : $user->phone,
            'password' => isset($request['password']) ? Hash::make($request['password']) : $user->password,
            'photo' => isset($request['photo']) ? $request['photo'] : $user->photo,
            'gender' => isset($request['gender']) ? $request['gender'] : $user->gender,
            'dob' => isset($request['dob']) ? date('Y-m-d', strtotime($request['dob'])) : $user->dob,
            'university' => isset($request['university']) ? $request['university'] : $user->university,
            'college' => isset($request['college']) ? $request['college'] : $user->college,
            'high_school' => isset($request['high_school']) ? $request['high_school'] : $user->high_school,
            'education' => isset($request['education']) ? $request['education'] : $user->education,
            'position' => isset($request['position']) ? $request['position'] : $user->position,
            'firm' => isset($request['firm']) ? $request['firm'] : $user->firm,
            'horoscope' => isset($request['horoscope']) ? $request['horoscope'] : $user->horoscope,
            'religion' => isset($request['religion']) ? $request['religion'] : $user->religion,
            'county' => isset($request['county']) ? $request['county'] : $user->county,
            'city' => isset($request['city']) ? $request['city'] : $user->city,
            'bio' => isset($request['bio']) ? $request['bio'] : $user->bio,
            'height' => isset($request['height']) ? $request['height'] : $user->height,
            'exercise' => isset($request['exercise']) ? $request['exercise'] : $user->exercise,
            'have_kids' => isset($request['have_kids']) ? $request['have_kids'] : $user->have_kids,
            'want_kids' => isset($request['want_kids']) ? $request['want_kids'] : $user->want_kids,
            'martial_status' => isset($request['martial_status']) ? $request['martial_status'] : $user->martial_status,
            'languages' => isset($request['languages']) ? $request['languages'] : $user->languages()->pluck('language_id'),
            'images' => isset($request['images']) ? $request['images'] : $user->images()->pluck('path'),
            'smoking' => isset($request['smoking']) ? $request['smoking'] : $user->smoking,
            'fb_user_id' => isset($request['fb_user_id']) ? $request['fb_user_id'] : $user->fb_user_id
        ]);
    }
}
