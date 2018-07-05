<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class Run extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:app';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '项目初始化';

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
        $this->call('jwt:key');
        // 创建数据库
        $this->call('migrate:fresh');

        $this->initial();
    }

    /**
     * 添加初始数据
     * @method initial
     *
     * @author luffyzhao@vip.126.com
     */
    protected function initial(){
        $files = $this->files();

        DB::transaction(function () use ($files) {
            foreach ($files as $file) {
                $this->read($file);
            }
        });
    }

    /**
     * 读取sql文件内容
     * @method read
     * @param $file
     * @throws \Exception
     *
     * @author luffyzhao@vip.126.com
     */
    protected function read($file){
        $handle = @fopen($file, "r");
        if(!$handle){
            throw new \Exception('文件读取失败');
        }
        while (($buffer = fgets($handle)) !== false) {
            $this->insert($buffer);
        }
        fclose($handle);
    }

    /**
     * 插入sql
     * @method insert
     * @param $sql
     *
     * @author luffyzhao@vip.126.com
     */
    protected function insert($sql){
        DB::insert($sql);
    }

    /**
     * 要导入的sql文件
     * @method files
     *
     * @return array
     *
     * @author luffyzhao@vip.126.com
     */
    protected function files(){
        return [
            database_path('backup') . '/base_permissions.sql',
            database_path('backup') . '/base_roles.sql',
            database_path('backup') . '/base_permission_role.sql',
            database_path('backup') . '/base_logs.sql',
            database_path('backup') . '/base_admins.sql',
        ];
    }
}
