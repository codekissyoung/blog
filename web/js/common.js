// 代码高亮
hljs.initHighlightingOnLoad();
// 异步加载文章
$('#main_category a').on('click',function(){
    $("#main_category a").removeClass('active');
    $(this).addClass('active');
    var href = $(this).attr('href');
    $.ajax({
        url:href + "?ajax=1",
        type:'GET',
        data:{},
        dataType:'text',
        timeout:5000,
        success:function(data){
            $("#article").empty().append($(data)).find('pre code').each(function(i,block){
                hljs.highlightBlock(block);
            });
            var title = href;
            var newUrl = href;
            // console.log(href);
            history.pushState({},title,newUrl);
        }
    });
    return false; // 阻止冒泡 阻止事件
});

// 目录折叠
$("#main_category>ul h2").on('click',function () {
    if($(this).next().hasClass('hide')){
        $(this).next().removeClass('hide').hasClass('show');
    }else{
        $(this).next().removeClass('show').addClass('hide');
    }
});

// Websocket
/*
var ws = new WebSocket("ws://dadishe.com:2345");
ws.onopen = function ()
{
    console.log("connenct success !\n");
    ws.send("ping");
    console.log("send ping \n");
}
ws.onmessage = function(e)
{
    console.log( "get message : " + e.data );
}
*/
