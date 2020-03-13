<?php
use Illuminate\Support\Facades\Route;
use App\Models\Attachment;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/socketio', function () {
    return view('socketio');
});

Route::get('/download', function (Request $request) {
        $attach = Attachment::where('code',$request->input('code'))->first();
        if(!$attach){
            die('下载失败，文件不存在');
        }
        $file = public_path().$attach->path;
        if(!file_exists($file)){
            die('下载失败，文件不存在');
        }
        $filename = $attach->filename;;
        header("Content-Type: application/force-download");
        header("Content-type:text/html;charset=utf-8");
        header('Content-Disposition: attachment; filename='. $filename);
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        readfile($file);
});

Route::get('/test', 'TestController@test');
