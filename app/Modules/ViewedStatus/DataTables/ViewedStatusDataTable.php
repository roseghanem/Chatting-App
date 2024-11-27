<?php


namespace App\Modules\ViewedStatus\DataTables;

use App\Modules\ViewedStatus\Models\ViewedStatus;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ViewedStatusDataTable
{
    public static function toJson(Request $request)
    {
        $query = ViewedStatus::select('*')->orderBy("id", 'desc');
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
