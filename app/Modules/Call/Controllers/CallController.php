<?php

namespace App\Modules\Call\Controllers;

use App\Modules\Call\Actions\DeleteCallAction;
use App\Modules\Call\Actions\StoreCallAction;
use App\Modules\Call\Actions\UpdateCallAction;
use App\Modules\Call\DTO\CallDTO;
use App\Modules\Call\Models\Call;
use App\Modules\Call\Requests\StoreCallRequest;
use App\Modules\Call\Requests\UpdateCallRequest;
use App\Modules\Call\ViewModels\CallIndexVM;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use App\Modules\Call\ViewModels\CallShowVM;


class CallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $response = Helper::createSuccessResponse(CallIndexVM::toArray());
        return response()->json($response, $response['code']);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCallRequest $storeCallRequest)
    {
        $CallDTO = CallDTO::fromRequest($storeCallRequest);
        $response = Helper::createResponse(StoreCallAction::execute($CallDTO));
        return response()->json($response, $response['code']);
    }

    /**
     * Display the specified resource.
     *
     * @param Call $Call
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($Call)
    {
        //
        $Call = Call::find($Call);
        $response = Helper::createSuccessResponse(CallShowVM::toArray($Call));
        return response()->json($response, $response['code']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCallRequest $updateCallRequest
     * @param Call $Call
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCallRequest $updateCallRequest, $Call)
    {
        //
        $Call = Call::find($Call);
        $CallDTO = CallDTO::fromRequestForUpdate($updateCallRequest, $Call);
        $response = Helper::createResponse(UpdateCallAction::execute($Call, $CallDTO));
        return response()->json($response, $response['code']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Call $Call
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($Call)
    {
        //
        $Call = Call::find($Call);
        $response = Helper::createResponse(DeleteCallAction::execute($Call));
        return response()->json($response, $response['code']);
    }
}
