<?php
namespace App\HttpController;
use EasySwoole\Core\Http\AbstractInterface\Controller;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Model\User;
/*
*系统方法类
*/
class Hello extends Controller
{
    function index()
    {
        // TODO: Implement index() method.
        $this->response()->write('hello world');
    }
	//获取方法名称
	function getActionData(){
		var_dump($this->getActionName());
	}
	//返回json的格式
	function getApiJson(){
		$result=array('userName'=>'zjh','password'=>'123456');
		$this->writeJson(200,$result,'请求成功');
	}
	//校验当前请求参数
	function checkParams(){
		//var_dump($this->response()->validateParams(Rules $rules));
	}
	//获取get请求的参数（注意的是：get请求暂时发现的是？&格式进行，斜杠参数请求暂时还没用到）
	function getGetParams(){
		var_dump($this->request()->getQueryParams());
	}
	//获取post的请求参数
	function getPostParams(){
		var_dump($this->request()->getParsedBody());
	}
	//获取既是post又是get的值
	function getRequestParams(){
		var_dump($this->request()->getRequestParam());
	}
	//获取swoole Request对象
	function getSwooleRequest(){
		//该方法用于获取当前的swoole_http_request对象。
		var_dump($this->request()->getSwooleRequest());
	}
	//获取客户端上传的全部文件
	function getUploadfiles(){
		var_dump($this->request()->getUploadedFiles());
	}
	//获取前端传过来的json数据
	function getJsonData(){
		$content = $this->request()->getBody()->__toString();
		$raw_array = json_decode($content, true);
	}
	//获取头部信息
	function getHeaders(){
		$this->request()->getHeaders();
	}
	//获取server参数
	function getServerParams(){
		var_dump($this->request()->getServerParams());
	}
	//获取cookie的参数
	function getCookieParams(){
		var_dump($this->request()->getCookieParams());
	}
	/**
	*respone
	*/
	//网页重定向
	function toRedirect(){
		$this->response()->redirect("/Hello/getApiJson");
	}
	//设置cookie
	function setTheCookie(){
		setCookie('dddd');
	}
	//
	function getSwooleRespon(){
		//getSwooleResponse
	}
	//手动指定返回状态吗
	function sendStatus(){
		$this->response()->withStatus($statusCode);
	}
	//向客户端发送header
	function sendHeader(){
		$this->response()->withHeader('Content-type','application/json;charset=utf-8');
	}
	//测试用laravel库的Illuminate\Database库连接是否成功
	function laravelData(){
		$version = Capsule::select('select * from sw_users');
		var_dump($version);
		//$this->response()->write($version);
	}
	//laravel数据库查询某条记录信息
	function getUserInfo(){
		$params=$this->request()->getQueryParams();
		var_dump($params);
		
		$userInfo=Capsule::table('users')->where('userName','=',$params['userName'])->get();
		var_dump($userInfo);	
	}
	//用select查出用两个参数查询的记录
	function getSelectCondition(){
		$params=$this->request()->getQueryParams();
		var_dump($params);
		$params2=array(0=>$params['userName'],1=>$params['password']);
		$userInfo=Capsule::select('select * from sw_users where userName=? and password=?',$params2);
		var_dump($userInfo);
	}
	//创建表格
	function createTable(){
		Capsule::schema()->create('area', function ($table) {
    $table->increments('id');
    $table->string('areaName')->unique();
    $table->timestamps();
	});
	}
	//使用laravel Eloquent数据库操作
	function eloquentTest(){
		   // 查询id为2的
    $user = User::find(2);

    // 查询全部
    //$users = User::all();

    // 创建数据
   // $user = new User;
    $user->userName = 'lalala';
    $user->password = 'haha@xxx.com';
    $user->save();
	}
	
}