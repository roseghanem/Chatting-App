<?php


namespace App\Modules\TemplateModule\Actions;

use App\Helpers\Helper;
use App\Modules\TemplateModule\DTO\TemplateModuleDTO;
use App\Modules\TemplateModule\Models\TemplateModule;

class StoreTemplateModuleAction
{

    public static function execute(TemplateModuleDTO $TemplateModuleDTO)
    {
        $TemplateModule = new TemplateModule($TemplateModuleDTO->toArray());
        $TemplateModule->save();
        return Helper::createSuccessResponse(['TemplateModule' => $TemplateModule], 'Added Successfully');
    }
}
