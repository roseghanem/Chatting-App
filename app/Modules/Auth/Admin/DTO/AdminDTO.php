<?php


namespace App\Modules\Auth\Admin\DTO;

use Illuminate\Support\Facades\Hash;
use Spatie\DataTransferObject\DataTransferObject;


class AdminDTO extends DataTransferObject
{

    /** @var string $name */
    public $name;

    /** @var string $email */
    public $email;

    /** @var string $password */
    public $password;

    /** @var string $phone */
    public $phone;

    public static function fromRequest($request)
    {
        return new self([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'password' => Hash::make($request['password'])
        ]);
    }

    public static function fromRequestForUpdate($request, $admin)
    {
        return new self([
                'name' => isset($request['name']) ? $request['name'] : $admin->name,
                'email' => isset($request['email']) ? $request['email'] : $admin->email,
                'phone' => isset($request['phone']) ? $request['phone'] : $admin->phone,
                'password' => isset($request['password']) ? Hash::make($request['password']) : $admin->password]
        );
    }
}
