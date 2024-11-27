<?php


namespace App\Modules\Auth\User\DataTables;

use App\Modules\Auth\User\Models\User;
use App\Modules\TemplateModule\Models\TemplateModule;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserDataTable
{
    public static function toJson(Request $request)
    {
        $data = User::select('*');
        $data = Datatables::of($data)
        ->filter(function ($query) {
            if (isset(request('search')['value'])) {
                $query->where('name', 'like', "%" . request('search')['value'] . "%")
                    ->orWhere('email', 'like', "%" . request('search')['value'] . "%");
            }

            if (isset(request('filter')['name'])) {
                $query->where('name', 'like', "%" . request('filter')['name'] . "%");
            }

            if (isset(request('filter')['email'])) {
                $query->where('email', 'like', "%" . request('filter')['email'] . "%");
            }

        })
            ->toJson();
        return $data;
    }

}
