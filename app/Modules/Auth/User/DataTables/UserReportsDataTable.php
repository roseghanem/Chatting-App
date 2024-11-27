<?php


namespace App\Modules\Auth\User\DataTables;

use App\Modules\Auth\User\Models\MatchRequest;
use App\Modules\Auth\User\Models\User;
use App\Modules\Auth\User\Models\UserReports;
use App\Modules\TemplateModule\Models\TemplateModule;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserReportsDataTable
{
    public static function toJson(Request $request)
    {
        $data = UserReports::select('*');
        $data = Datatables::of($data)
        ->filter(function ($query) {
        })
            ->toJson();
        return $data;
    }

}
