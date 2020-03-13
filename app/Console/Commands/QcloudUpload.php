<?php

namespace App\Console\Commands;

use Vod\VodUploadClient;
use App\Models\Course;
use Vod\Model\VodUploadRequest;
use Illuminate\Console\Command;
use Illuminate\Http\Request;

class QcloudUpload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:qu';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'upload to tencent';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //获取所有的url不是腾讯url的录播课
        $list = Course::where("type",2)
        ->where("url","like","%".config('app.url')."%")
        ->get();
        $client = new VodUploadClient(config('app.tx_secret_id'), config('app.tx_secret_key'));
        foreach($list as $item){
            try {
                //上传到腾讯云存储
                $dir = "/video/";
                $filepath = storage_path("app/public").$dir.end(explode("/",$item["url"]));
                if(!file_exists($filepath)){
                    continue;
                }
                $req = new VodUploadRequest();
                $req->MediaFilePath = $filepath;
                $client->setLogPath(storage_path("app/upload.video.log"));
                $rsp = $client->upload("ap-guangzhou", $req);
                $item->url = $rsp->MediaUrl;
                $item->save();
                unlink($filepath);
            } catch (\Exception $e) {
                // 处理上传异常
                dump($e);
            }
        }
    }
}
