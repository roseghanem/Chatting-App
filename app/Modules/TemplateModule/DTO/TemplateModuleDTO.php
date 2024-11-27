<?php


namespace App\Modules\TemplateModule\DTO;

use Spatie\DataTransferObject\DataTransferObject;


class TemplateModuleDTO extends DataTransferObject
{

    /** @var string $key */
    public $key;

    public static function fromRequest($request)
    {
        return new self([
            'key' => $request['key']
        ]);
    }

    public static function fromRequestForUpdate($request, $TemplateModule)
    {
        return new self([
            'key' => isset($request['key']) ? $request['key'] : $TemplateModule->key
        ]);
    }
}
