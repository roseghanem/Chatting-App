<?php

namespace App\Modules\TemplateModule\ViewModels;

use App\Modules\TemplateModule\Models\TemplateModule;

class TemplateModuleIndexVM
{

    public static function handle()
    {
        $TemplateModules = TemplateModule::all();
        $arr = [];
        foreach ($TemplateModules as $TemplateModule) {
            $TemplateModuleVM = new TemplateModuleShowVM();
            array_push($arr, $TemplateModuleVM->toAttr($TemplateModule));
        }
        return $arr;
    }

    public static function toArray()
    {
        return ['TemplateModules' => self::handle()];
    }
}
