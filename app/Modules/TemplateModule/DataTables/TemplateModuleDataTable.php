<?php


namespace App\Modules\TemplateModule\DataTables;

use App\Modules\TemplateModule\Models\TemplateModule;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TemplateModuleDataTable
{
    public static function toJson(Request $request)
    {
        $query = TemplateModule::select('*')->orderBy("id", 'desc');
        $response = Datatables::of($query)
            ->filter(function ($query) {
                if (isset(request('filter')['key'])) {
                    $query->where('key', 'like', "%" . request('filter')['key'] . "%");
                }
            })
            ->toJson();
        return $response;
    }

}
