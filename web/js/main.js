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
    },

    // 引入没有按照 require 风格编写的库
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
require(['code_highlight','article']);
