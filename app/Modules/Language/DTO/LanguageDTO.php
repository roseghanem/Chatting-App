<?php


namespace App\Modules\Language\DTO;

use Spatie\DataTransferObject\DataTransferObject;


class LanguageDTO extends DataTransferObject
{

    /** @var string $name */
    public $name;

    public static function fromRequest($request)
    {
        return new self([
            'name' => $request['name']
        ]);
    }

    public static function fromRequestForUpdate($request, $Language)
    {
        return new self([
            'name' => isset($request['name']) ? $request['name'] : $Language->name
        ]);
    }
}
