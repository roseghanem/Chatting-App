<?php


namespace App\Modules\Auth\User\DataTables;

use App\Modules\Auth\User\Models\MatchRequest;
use App\Modules\Auth\User\Models\User;
use App\Modules\TemplateModule\Models\TemplateModule;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MatchRequestDataTable
{
    public static function toJson(Request $request)
    {
        $data = MatchRequest::select('*');
        $data = Datatables::of($data)
        ->filter(function ($query) {
        })
            ->toJson();
        return $data;
    }

}
