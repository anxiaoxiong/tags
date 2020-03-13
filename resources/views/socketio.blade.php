<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <title>laravel整合phpSocketIo</title>
</head>
<body>
<h1>laravel整合phpSocketIo</h1>
<h2>实现laravel服务端推送消息到web端</h2>
<h5>效果查看console</h5>


<script src='https://cdn.bootcss.com/socket.io/2.0.3/socket.io.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        //const uid = Date.now(), //这个识别id可以换成项目相应业务的id,同一个id可以多端登录,能同时收到消息
        const uid = 131, //这个识别id可以换成项目相应业务的id,同一个id可以多端登录,能同时收到消息
            domain = document.domain, //当前打开页面的域名或ip
            sendToOneApi = `http://${domain}:2121/?type=publish&content=msg_content&to=${uid}`,
            sendToAllApi = `http://${domain}:2121/?type=publish&content=msg_content`,
            socket = io(`http://${domain}:2120`); // 连接socket服务端

        console.log('给指定uid登录端发送消息接口: ', sendToOneApi); //支持get和post方法
        console.log('给所有登录端发送消息接口: ', sendToAllApi);

        // 连接后登录
        socket.on('connect', function () {
            socket.emit('login', uid);
        });

        // 后端推送来消息时
        socket.on('new_msg', function (msg) {
            console.log('收到消息: ' + msg);
        });

        // 后端推送来在线数据时
        socket.on('update_online_count', function (online_stat) {
            console.log('即时在线数据: ', online_stat);
        });

    });
</script>
</body>
</html>