<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;
use Config;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var int 每页数量
     */
    public $limit = 20;

   /**
     * 数据返回格式
     *
     * @param $code
     * @param $data
     * @return Illuminate\Http\Response
     */
    public function success($message = '操作成功', $data = null)
    {
        $result = array(
            'code' => 200,
            'message' => $message
        );

        if ($data !== null) {
            $result['data'] = $data;
        }
        return response()->json($result);
    }

    /**
     * 错误返回格式
     * @param $code 错误码
     * @param $message 错误信息
     * @return Illuminate\Http\Response
     */
    public function error($code = 500, $message = '操作错误')
    {

        $result = array(
            'code' => $code,
            'message' => $message
        );

        return response()->json($result);
    }
}
