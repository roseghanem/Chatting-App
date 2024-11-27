<?php


namespace App\Modules\Language\DataTables;

use App\Modules\Language\Models\Language;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LanguageDataTable
{
    public static function toJson(Request $request)
    {
        $query = Language::select('*')->orderBy("id", 'desc');
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
