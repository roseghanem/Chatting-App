<?php

namespace App\Modules\Language\Controllers;

use App\Modules\Language\Actions\DeleteLanguageAction;
use App\Modules\Language\Actions\StoreLanguageAction;
use App\Modules\Language\Actions\UpdateLanguageAction;
use App\Modules\Language\DataTables\UserDataTable;
use App\Modules\Language\DTO\LanguageDTO;
use App\Modules\Language\Models\Language;
use App\Modules\Language\Requests\StoreLanguageRequest;
use App\Modules\Language\Requests\UpdateLanguageRequest;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use App\Modules\Language\ViewModels\LanguageShowVM;
use Illuminate\Http\Request;

class LanguageDashboardController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $response = UserDataTable::toJson($request);
        $response = Helper::createSuccessDTResponse($response, '');
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Language $Language
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Language $Language)
    {
        //
        $response = Helper::createSuccessResponse(LanguageShowVM::toArray($Language));
        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreLanguageRequest $storeLanguageRequest)
    {
        $LanguageDTO = LanguageDTO::fromRequest($storeLanguageRequest);
        $response = Helper::createResponse(StoreLanguageAction::execute($LanguageDTO));
        return response()->json($response, $response['code']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateLanguageRequest $updateLanguageRequest, $Language)
    {
        $Language = Language::find($Language);
        $LanguageDTO = LanguageDTO::fromRequestForUpdate($updateLanguageRequest, $Language);
        $response = Helper::createResponse(UpdateLanguageAction::execute($Language, $LanguageDTO));
        return response()->json($response, $response['code']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Language $Language
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($Language)
    {
        //
        $Language = Language::find($Language);
        $response = Helper::createResponse(DeleteLanguageAction::execute($Language));
        return response()->json($response, $response['code']);
    }
}
