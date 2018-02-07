console.log("codekissyoung blog start！");
require.config({
    baseUrl:'/js/',
    paths:{
        'jquery'            :   'jquery-3.3.1.min',
        'bootstrap'         :   'bootstrap/bootstrap.min',
        'highlight'         :   'highlight.pack',
        'code_highlight'    :   'mod_code_highlight',
        'article'           :   'mod_article',
        'underscore'        :   'underscore',
        'backbone'          :   'backbone',
        'hello_world'       :   'backbone_hello_world',
    },

    // 引入没有按照 require 风格编写的库
    // shim 属性专门用来配置不兼容的模块
    // 格式: { '模块名' : { exports : '暴露的变量名', deps : ['依赖模块1','依赖模块2'] } ... }
    shim : {
        'underscore' : {
            exports : '_'
        },
        'backbone' : {
            'deps' : [
                'underscore',
                'jquery'
            ],
            exports : 'Backbone'
        },
    },

    // 网站加载脚本timeout, 默认是 7s , 0 表示不设置超时时间
    waitSeconds : 0,
});

// 加载代码高亮模块
require(['code_highlight','article','hello_world'],function(code_light,article,hello_world){
    code_light.log();
    article.log();
    hello_world.log();
});
