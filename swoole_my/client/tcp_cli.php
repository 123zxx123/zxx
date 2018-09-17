<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/20
 * Time: 10:15
 */

//创建swoole_tcp服务
$cli = new swoole_client(SWOOLE_SOCK_TCP);

if(!$cli->connect("127.0.0.1",9501)){
    echo '连接失败';
}

//php cli 常量
fwrite(STDOUT,"请输入消息:");
$msg = trim(fgets(STDIN));

//发送给tcp_server服务器
$cli->send($msg);

//接受来自服务器的数据
$result = $cli->recv();

//echo $result;