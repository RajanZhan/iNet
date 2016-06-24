/**
 * Created by Administrator on 2016/3/27.
 */
function iChat() {
    this.ws = new WebSocket("ws://119.29.104.213:2346");
    var _this = this;
   _this.login_key = localStorage.getItem("login_key");
    this.ws.onopen = function () {
        console.log("连接成功");
       // _this.send('我的消息');
        console.log("给服务端发送一条消息");
    };
    this.ws.onmessage = function (e) {

        console.log("收到服务端的消息：" + e.data);
        var json = JSON.parse(e.data);

        /*if(json.login_key)
        {
            localStorage.setItem("login_key",json.login_key);
            console.log("save login_key");
        }*/

        if(json.js)
        {
            eval(json.js);
        }
    };

    this.ws.onclose = function (data) {
        //console.log("关闭链接");
        console.log("关闭连接：".data);
    };

    this.login= function (user_name,pwd) {

        if(!user_name || !pwd)
        {
            throw "用户名和密码不能为空";
            return;
        }
        var msg = {type:"login", userName:user_name,pwd:pwd,safe_code: '112',login_key:_this.login_key};
        _this.ws.send(JSON.stringify(msg))
    };

    this.logout = function () {
        var login_key = localStorage.getItem("login_key");
        var msg = {type:"logout", login_key:login_key,safe_code: '112'};
        _this.ws.send(JSON.stringify(msg))
    }

    this.send1 = function (msg, type, to) {
        try
        {
            type = type ? type : 'text';
            to = to ? to : 'null';
            var login_key = localStorage.getItem("login_key");
            var msg = {msg: msg, type: type, to: to, safe_code: '112',login_key:login_key,};
            _this.ws.send(JSON.stringify(msg))
        }
        catch(e)
        {
            alert("发送消息失败:"+ e.message);
        }

    }

    this.send = function (data) {
        try
        {
            /*type = type ? type : 'text';
            to = to ? to : 'null';
            var login_key = localStorage.getItem("login_key");
            var msg = {msg: msg, type: type, to: to, safe_code: '112',login_key:login_key};*/
            //safe_code:'112',login_key:login_key,func:""
            data.safe_code = '112';
            data.login_key = getLoginInfo();
            data.func = " ";
            _this.ws.send(JSON.stringify(data))
        }

        catch(e)
        {
            alert("发送消息失败:"+ e.message);
        }
    }
}

function netClass ()
{
    this.ws = new WebSocket("ws://119.29.104.213:2346");
    var _this = this;
    this.ws.onopen = function () {
        console.log("连接成功");
        // _this.send('我的消息');
        console.log("给服务端发送一条消息");
    };
    this.ws.onmessage = function (e) {

        console.log("收到服务端的消息：\r\n");
        //var json = JSON.parse(e);
        console.log(e);

        /*if(json.js)
         {
         eval(json.js);
         }*/
    };
    this.ws.onclose = function (data) {
        var _data = JSON.parse(data)
        console.log("关闭连接："._data);
    };
    this.send = function (data) {
        _this.ws.send(JSON.stringify(data))
    }
}




