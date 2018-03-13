<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/1/9
 * Time: 下午1:04
 */

namespace EasySwoole;

use \EasySwoole\Core\AbstractInterface\EventInterface;
use \EasySwoole\Core\Swoole\ServerManager;
use \EasySwoole\Core\Swoole\EventRegister;
use \EasySwoole\Core\Http\Request;
use \EasySwoole\Core\Http\Response;
use Illuminate\Database\Capsule\Manager as Capsule;
use \EasySwoole\Core\Swoole\EventHelper;
use \EasySwoole\Core\Http\Parser;

Class EasySwooleEvent implements EventInterface {

    public function frameInitialize(): void
    {
        // TODO: Implement frameInitialize() method.
        date_default_timezone_set('Asia/Shanghai');
         // 初始化数据库
        $dbConf = Config::getInstance()->getConf('database');
        $capsule = new Capsule;
        // 创建链接
        $capsule->addConnection($dbConf);
        // 设置全局静态可访问
        $capsule->setAsGlobal(); 
        // 启动Eloquent
        $capsule->bootEloquent();
    }

    public function mainServerCreate(ServerManager $server,EventRegister $register): void
    {
        // TODO: Implement mainServerCreate() method.
		 EventHelper::registerDefaultOnMessage($register,new Parser());
    }

    public function onRequest(Request $request,Response $response): void
    {
        // TODO: Implement onRequest() method.
    }

    public function afterAction(Request $request,Response $response): void
    {
        // TODO: Implement afterAction() method.
    }
}