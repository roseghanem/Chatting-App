<?php

namespace App\Modules\ViewedStatus\Controllers;

use App\Modules\ViewedStatus\Actions\DeleteViewedStatusAction;
use App\Modules\ViewedStatus\Actions\StoreViewedStatusAction;
use App\Modules\ViewedStatus\Actions\UpdateViewedStatusAction;
use App\Modules\ViewedStatus\DTO\ViewedStatusDTO;
use App\Modules\ViewedStatus\Models\ViewedStatus;
use App\Modules\ViewedStatus\Requests\StoreViewedStatusRequest;
use App\Modules\ViewedStatus\Requests\UpdateViewedStatusRequest;
use App\Modules\ViewedStatus\ViewModels\ViewedStatusIndexVM;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use App\Modules\ViewedStatus\ViewModels\ViewedStatusShowVM;


class ViewedStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $response = Helper::createSuccessResponse(ViewedStatusIndexVM::toArray());
        return response()->json($response, $response['code']);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreViewedStatusRequest $storeViewedStatusRequest)
    {
        $ViewedStatusDTO = ViewedStatusDTO::fromRequest($storeViewedStatusRequest);
        $response = Helper::createResponse(StoreViewedStatusAction::execute($ViewedStatusDTO));
        return response()->json($response, $response['code']);
    }

    /**
     * Display the specified resource.
     *
     * @param ViewedStatus $ViewedStatus
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($ViewedStatus)
    {
        //
        $ViewedStatus = ViewedStatus::find($ViewedStatus);
        $response = Helper::createSuccessResponse(ViewedStatusShowVM::toArray($ViewedStatus));
        return response()->json($response, $response['code']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateViewedStatusRequest $updateViewedStatusRequest
     * @param ViewedStatus $ViewedStatus
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateViewedStatusRequest $updateViewedStatusRequest, $ViewedStatus)
    {
        //
        $ViewedStatus = ViewedStatus::find($ViewedStatus);
        $ViewedStatusDTO = ViewedStatusDTO::fromRequestForUpdate($updateViewedStatusRequest, $ViewedStatus);
        $response = Helper::createResponse(UpdateViewedStatusAction::execute($ViewedStatus, $ViewedStatusDTO));
        return response()->json($response, $response['code']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ViewedStatus $ViewedStatus
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($ViewedStatus)
    {
        //
        $ViewedStatus = ViewedStatus::find($ViewedStatus);
        $response = Helper::createResponse(DeleteViewedStatusAction::execute($ViewedStatus));
        return response()->json($response, $response['code']);
    }
}
