<?php


namespace App\Modules\Auth\User\DTO;

use Illuminate\Support\Facades\Hash;
use Spatie\DataTransferObject\DataTransferObject;


class UserDTO extends DataTransferObject
{

    /** @var string $name */
    public $name;

    /** @var string $email */
    public $email;

    /** @var string $password */
    public $password;

    /** @var string $phone */
    public $phone;

    /** @var string $photo */
    public $photo;

    /** @var string $id_token */
    public $id_token;

    /** @var string $gender */
    public $gender;

    /** @var date $dob */
    public $dob;

    /** @var string $university */
    public $university;

    /** @var string $college */
    public $college;

    /** @var string $high_school */
    public $high_school;

    /** @var string $education */
    public $education;

    /** @var string $position */
    public $position;

    /** @var string $firm */
    public $firm;

    /** @var string $horoscope */
    public $horoscope;

    /** @var string $religion */
    public $religion;

    /** @var string $county */
    public $county;

    /** @var string $city */
    public $city;

    /** @var string $bio */
    public $bio;

    /** @var integer $height */
    public $height;

    /** @var string $exercise */
    public $exercise;

    /** @var boolean $have_kids */
    public $have_kids;

    /** @var boolean $want_kids */
    public $want_kids;

    /** @var boolean $martial_status */
    public $martial_status;

    /** @var array $languages */
    public $languages;

    /** @var array $images */
    public $images;

    /** @var string $smoking */
    public $smoking;

    /** @var string $fb_user_id */
    public $fb_user_id;

    /** @var int $subscription_plan_id */
    public $subscription_plan_id;

    /** @var int $max_sent_req */
    public $max_sent_req;

    public static function fromRequest($request)
    {
        return new self([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'password' => Hash::make($request['password']),
            'id_token' => $request['id_token'],
            'gender' => $request['gender'],
            'dob' => $request['dob'],
            'university' => $request['university'],
            'college' => $request['college'],
            'high_school' => $request['high_school'],
            'education' => $request['education'],
            'position' => $request['position'],
            'firm' => $request['firm'],
            'horoscope' => $request['horoscope'],
            'religion' => $request['religion'],
            'county' => $request['county'],
            'city' => $request['city'],
            'bio' => $request['bio'],
            'height' => $request['height'],
            'exercise' => $request['exercise'],
            'have_kids' => $request['have_kids'],
            'want_kids' => $request['want_kids'],
            'martial_status' => $request['martial_status'],
            'languages' => $request['languages'],
            'images' => $request['images'],
            'smoking' => $request['smoking'],
            'fb_user_id' => $request['fb_user_id'],
            'subscription_plan_id' => $request['subscription_plan_id'],
            'max_sent_req'=>10,
        ]);
    }

    public static function fromRequestForUpdate($request, $user)
    {
        return new self([
            'name' => isset($request['name']) && $request['name'] ? $request['name'] : $user->name,
            'email' => isset($request['email']) && $request['email'] ? $request['email'] : $user->email,
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
            'fb_user_id' => isset($request['fb_user_id']) ? $request['fb_user_id'] : $user->fb_user_id,
            'subscription_plan_id' => isset($request['subscription_plan_id']) ? $request['subscription_plan_id'] : $user->subscription_plan_id,
            'max_sent_req' => isset($request['max_sent_req']) ? $request['max_sent_req'] : $user->max_sent_req,
        ]);
    }
}
