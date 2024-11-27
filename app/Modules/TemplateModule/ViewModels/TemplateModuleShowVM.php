<?php

namespace App\Modules\TemplateModule\ViewModels;

use App\Modules\TemplateModule\Models\TemplateModule;

class TemplateModuleShowVM
{

    public static function handle($TemplateModule)
    {
        return $TemplateModule;
    }

    public static function toArray(TemplateModule $TemplateModule)
    {
        return ['TemplateModule' => self::handle($TemplateModule)];
    }

    public static function toAttr(TemplateModule $TemplateModule)
    {
        return self::handle($TemplateModule);
    }
}
