# 概述
- 依照Backbone进行代码结构组织，将页面中的数据，逻辑，视图解耦
- Backbone `Model` 可以被继承，可以方便的重载和拓展自定义方法
- 内置与服务器交互规则(基于REST架构)，数据同步工作在Model中自动进行，前端开发人员只需对客户端数据进行操作，Backbone会自动将操作的数据同步到服务器
- Backbone中的 `view` 将用户事件和处理事件的方法有序的组织起来
- 使用 `Underscore` 轻量级模板解析,帮助我们更好的分离视图结构与逻辑，还可以将视图中的 HTML 结构独立管理，比如不同状态显示不同的HTML结构，写成模板，按需加载
- 自定义事件管理，`model.on('xx',function(){...})` 自定义事件 , `model.trigger('xx')` 触发事件

# model
- 代表一个数据模型

# collection
- 是model的一个集合

# view
```js
events:{
    'click #save': 'add', // 单击id为 'save' 的元素，执行视图的 add 方法
}
```
- 处理页面以及简单的页面逻辑的
- 在表达式中，事件:( click、mouseover、keypress等) , 元素：jQuery支持的任意选择器（如标签选择器、id选择器、class选择器等）。View自动将事件绑定到选择器元素，事件被触发后，自动调用方法。

# 路由器
```js
var CustomRouter = Backbone.Router.extend({  
    routes : {  
        '' : 'index', // 当URL Hash在根目录时执行index方法：url#  
        'list' : 'getList', // 当URL Hash在list节点时执行getList方法：url#list  
        'detail/:id' : 'query', // 当URL Hash在detail节点时执行query方法，并将detail后的数据作为参数传递给query方法：url#list/1001  
        '*error' : 'showError' // 当URL Hash不匹配以上规则时, 执行error方法  
    },  
    index : function() {  
        alert('index');  
    },  
    getList : function() {  
        alert('getList');  
    },  
    query : function(id) {  
        alert('query id: ' + id);  
    },  
    // 当URL Hash发生变化时，会执行所绑定的方法，当遇到没有定义的Hash时，都会 执行showError方法，并将未定义的Hash传递给该方法
    showError : function(error) {  
        alert('error hash: ' + error);  
    }, 
});
var custom = new CustomRouter();  
Backbone.history.start();
// 在浏览器中输入
// URL
// URL#list
// URL#detail/1001
// URL#hash1
// URL#hash2
```
- 在单页应用中，我们通过JavaScript来控制界面的切换和展现，并通过AJAX从服务器获取数据。可能产生的问题是，当用户希望返回到上一步操作时，他可能会习惯性地使用浏览器“返回”和“前进”按钮，而结果却是整个页面都被切换了，因为用户并不知道他正处于同一个页面中。
- 对于这个问题，我们常常通过Hash（锚点）的方式来记录用户的当前位置，并通过onhashchange事件来监听用户的“前进”和“返回”动作，但我们发现一些低版本的浏览器（例如IE6）并不支持onhashchange事件。对于不支持onhashchange的低版本浏览器，会通过setInterval心跳监听Hash的变化
- Backbone提供了路由控制功能，通过Backbone提供的路由器，我们能通过一个简单的表达式将路由地址和事件函数绑定在一起
# 资料
- [御剑神兵backbone.js](http://yujianshenbing.iteye.com/)
- [the5fire的技术博客backbone.js](https://www.the5fire.com/tag/backbone/)