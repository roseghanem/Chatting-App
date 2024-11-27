<?php


namespace App\Modules\Call\DataTables;

use App\Modules\Call\Models\Call;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CallDataTable
{
    public static function toJson(Request $request)
    {
        $query = Call::select('*')->orderBy("id", 'desc');
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
