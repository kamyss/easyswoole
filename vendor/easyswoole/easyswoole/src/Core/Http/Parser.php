<?php
namespace EasySwoole\Core\Http;


use EasySwoole\Core\Socket\AbstractInterface\ParserInterface;
use EasySwoole\Core\Socket\Common\CommandBean;
use EasySwoole\Core\Http\Test;

class Parser implements ParserInterface
{

    public function decode($raw, $client)
    {
		var_dump($raw);
		//var_dump($client);
        // TODO: Implement decode() method.
		//$test=new Test();
        $command = new CommandBean();
        $json = json_decode($raw,1);
        $command->setControllerClass(Test::class);
        $command->setAction($json['action']);
        $command->setArg('content',$json['content']);
        return $command;

    }

    public function encode(string $raw, $client, $commandBean): ?string
    {
        // TODO: Implement encode() method.
        return $raw;
    }
}