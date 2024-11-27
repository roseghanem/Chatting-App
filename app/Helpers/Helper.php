<?php // Code within app\Helpers\Helper.php
namespace App\Helpers;

use Illuminate\Support\Str;

class Helper
{

    public static function createResponse($tempResponse)
    {
        $response = ['success' => $tempResponse['success'] ?? true, 'data' => $tempResponse['data'] ?? null, 'message' => ($tempResponse['msg'] ?? $tempResponse['message']) ?? '', 'code' => $tempResponse['code'] ?? 200];
        return $response;
    }

    public static function createSuccessResponse($data = null, $msg = null)
    {
        $response = ['success' => true, 'message' => $msg, 'code' => 200];
        if ($data) {
            $response['data'] = $data;
        }
        return $response;
    }

    public static function createErrorResponse($data = null, $msg = null, $code = 500)
    {
        $response = ['success' => false, 'message' => $msg, 'code' => $code];
        if ($data) {
            $response['data'] = $data;
        }
        return $response;
    }

    public static function createSuccessDTResponse($data = null, $msg = null)
    {
        $response = ['success' => true, 'message' => $msg];
        $finalData = [];
        $finalData['list'] = $data->original['data'];
        $finalData['pagination'] = [
            'current_page' => $data->original['input']['page'],
            'limit' => $data->original['input']['limit'],
            'total' => $data->original['recordsFiltered'],
            'total_pages' => ceil($data->original['recordsFiltered'] / $data->original['input']['limit'])
        ];
        if ($data) {
            $response['data'] = $finalData;
        }
        return $response;
    }

    public static function plainData($arr)
    {
        $arr = array_filter($arr);
        $arr = !empty($arr) ? $arr[array_key_first($arr)] : null;
        return $arr;
    }
}
