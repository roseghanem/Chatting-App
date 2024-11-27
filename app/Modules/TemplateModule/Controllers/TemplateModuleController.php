<?php

namespace App\Modules\TemplateModule\Controllers;

use App\Modules\TemplateModule\Actions\DeleteTemplateModuleAction;
use App\Modules\TemplateModule\Actions\StoreTemplateModuleAction;
use App\Modules\TemplateModule\Actions\UpdateTemplateModuleAction;
use App\Modules\TemplateModule\DTO\TemplateModuleDTO;
use App\Modules\TemplateModule\Models\TemplateModule;
use App\Modules\TemplateModule\Requests\StoreTemplateModuleRequest;
use App\Modules\TemplateModule\Requests\UpdateTemplateModuleRequest;
use App\Modules\TemplateModule\ViewModels\TemplateModuleIndexVM;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use App\Modules\TemplateModule\ViewModels\TemplateModuleShowVM;


class TemplateModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $response = Helper::createSuccessResponse(TemplateModuleIndexVM::toArray());
        return response()->json($response, $response['code']);
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
     * Display the specified resource.
     *
     * @param TemplateModule $TemplateModule
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($TemplateModule)
    {
        //
        $TemplateModule = TemplateModule::find($TemplateModule);
        $response = Helper::createSuccessResponse(TemplateModuleShowVM::toArray($TemplateModule));
        return response()->json($response, $response['code']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTemplateModuleRequest $updateTemplateModuleRequest
     * @param TemplateModule $TemplateModule
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateTemplateModuleRequest $updateTemplateModuleRequest, $TemplateModule)
    {
        //
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
