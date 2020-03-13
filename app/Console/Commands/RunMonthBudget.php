<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RunMonthBudget extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:monthBudget';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '自动将每月固定预算添加到月度预算表';

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
        $res = false;
        $insertAll = [];
        $static = DB::table('budget_static')->whereNull('deleted_at')->get();
        if (!empty($static)) {
            foreach ($static as $item) {
                $insert = [];
                $insert['name'] = $item->name;
                $insert['type'] = $item->type;
                $insert['budget'] = $item->budget;
                $insert['cid'] = $item->cid;
                $insert['category'] = 1;
                $insert['created_at'] = $insert['updated_at'] = date('Y-m-d H:i:s');
                $insertAll[] = $insert;
            }
        }

        if (!empty($insertAll)) {
            $res = DB::table('budget_record')->insert($insertAll);
        }
        if ($res) {
            Log::info(date('Y年m月') . "固定预算已添加");
        }
    }
}
