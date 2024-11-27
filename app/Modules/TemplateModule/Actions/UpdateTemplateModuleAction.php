<?php


namespace App\Modules\TemplateModule\Actions;

use App\Helpers\Helper;
use App\Modules\TemplateModule\DTO\TemplateModuleDTO;
use App\Modules\TemplateModule\Models\TemplateModule;
use Illuminate\Support\Facades\Auth;

class UpdateTemplateModuleAction
{
    public static function execute(TemplateModule $TemplateModule, TemplateModuleDTO $TemplateModuleDTO)
    {
        $TemplateModule->update($TemplateModuleDTO->toArray());
        return Helper::createSuccessResponse(['TemplateModule' => $TemplateModule], 'Updated Successfully');
    }

}
