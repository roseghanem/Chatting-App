<?php


namespace App\Modules\TemplateModule\Actions;

use App\Helpers\Helper;
use App\Modules\TemplateModule\Models\TemplateModule;

class DeleteTemplateModuleAction
{
    public static function execute(TemplateModule $TemplateModule)
    {
        $TemplateModule->delete();
        return Helper::createSuccessResponse([], 'Deleted Successfully');
    }

}
