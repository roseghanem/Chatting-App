<?php

namespace App\Modules\TemplateModule\Controllers;

use App\Modules\TemplateModule\Actions\DeleteTemplateModuleAction;
use App\Modules\TemplateModule\Actions\StoreTemplateModuleAction;
use App\Modules\TemplateModule\Actions\UpdateTemplateModuleAction;
use App\Modules\TemplateModule\DataTables\UserDataTable;
use App\Modules\TemplateModule\DTO\TemplateModuleDTO;
use App\Modules\TemplateModule\Models\TemplateModule;
use App\Modules\TemplateModule\Requests\StoreTemplateModuleRequest;
use App\Modules\TemplateModule\Requests\UpdateTemplateModuleRequest;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use App\Modules\TemplateModule\ViewModels\TemplateModuleShowVM;
use Illuminate\Http\Request;

class TemplateModuleDashboardController extends Controller
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
     * @param TemplateModule $TemplateModule
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(TemplateModule $TemplateModule)
    {
        //
        $response = Helper::createSuccessResponse(TemplateModuleShowVM::toArray($TemplateModule));
        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreTemplateModuleRequest $storeTemplateModuleRequest)
    {
        $TemplateModuleDTO = TemplateModuleDTO::fromRequest($storeTemplateModuleRequest);
        $response = Helper::createResponse(StoreTemplateModuleAction::execute($TemplateModuleDTO));
        return response()->json($response, $response['code']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateTemplateModuleRequest $updateTemplateModuleRequest, $TemplateModule)
    {
        $TemplateModule = TemplateModule::find($TemplateModule);
        $TemplateModuleDTO = TemplateModuleDTO::fromRequestForUpdate($updateTemplateModuleRequest, $TemplateModule);
        $response = Helper::createResponse(UpdateTemplateModuleAction::execute($TemplateModule, $TemplateModuleDTO));
        return response()->json($response, $response['code']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TemplateModule $TemplateModule
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($TemplateModule)
    {
        //
        $TemplateModule = TemplateModule::find($TemplateModule);
        $response = Helper::createResponse(DeleteTemplateModuleAction::execute($TemplateModule));
        return response()->json($response, $response['code']);
    }
}
