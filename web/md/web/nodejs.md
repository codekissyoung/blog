# 安装
## 安装nvm
获取 nvm `git clone https://github.com/creationix/nvm.git`
安装 `./install.sh`
初始化`source ./nvm.sh`

## nvm 管理
`nvm ls-remote` 查看远程可用版本
`nvm ls` 查看本机版本
`nvm install v5.5.0` 安装5.5.0版本
`nvm use v5.5.0` 使用v5.5.0版本
`nvm alias default stable` 默认使用稳定版本

## npm 管理
npm 随着nodejs 安装
# 第一个nodejs程序
```
var http = require('http');
http.createServer(function (request, response) {
    	response.writeHead(200, {'Content-Type': 'text/plain'});
    	response.end('Hello World\n');
}).listen(8888);
console.log('Server running at http://127.0.0.1:8888/');
```
# 同步执行代码
```
var fs = require("fs");
var data = fs.readFileSync('input.txt');
console.log(data.toString());
console.log("程序执行结束!");
```
# 异步执行代码
```
var fs = require("fs");
fs.readFile('input.txt', function (err, data) {
    if (err) return console.error(err);
    console.log(data.toString());
});
console.log("程序执行结束!");
```
# 事件处理
http://www.runoob.com/nodejs/nodejs-event.html
```
// 引入 events 模块
var events = require('events');
// 创建 eventEmitter 对象
var eventEmitter = new events.EventEmitter();
// 创建事件处理程序
var connectHandler = function() {
   console.log('连接成功。');
   // 触发 data_received 事件
   eventEmitter.emit('data_received');
}
// 绑定 connection 事件处理程序
eventEmitter.on('connection', connectHandler);
// 使用匿名函数绑定 data_received 事件
eventEmitter.on('data_received', function(){
   console.log('数据接收成功。');
});
// 触发 connection 事件
eventEmitter.emit('connection');
console.log("程序执行完毕。");
```

# 回调函数
格式:err是错误信息,data是传入的数据
```javascript
function(err,data){ }
```
