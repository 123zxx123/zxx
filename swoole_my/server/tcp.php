<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/14
 * Time: 9:44
 */

//创建Server对象，监听 127.0.0.1:9501端口
$serv = new swoole_server("127.0.0.1", 9501);

$serv->set(array(
    'work_num'=> 3,//设置启动的worker进程数量。
));
//监听连接进入事件
/**
 * $fd 客服端连接的唯一标识
 * $reactor_id 线程id
 */
$serv->on('connect', function ($serv, $fd,$reactor_id) {
    echo "Client: {$reactor_id} - {$fd}- Connect.\n";
});

//监听数据接收事件

$serv->on('receive', function ($serv, $fd, $reactor_id, $data) {
    $serv->send($fd, "Server: {$reactor_id} - {$fd} ".$data);
});

//监听连接关闭事件
$serv->on('close', function ($serv, $fd) {
    echo "Client: Close.\n";
});

//启动服务器
$serv->start();