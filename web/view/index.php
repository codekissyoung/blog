<!DOCTYPE HTML>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta name="baidu-site-verification" content="PVkQXzqbOU" />
        <!-- 移动浏览器相关设置 -->
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> -->
        <title><?=$title?></title>
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">

        <link href="/css/highlight_styles/xcode.css" rel="stylesheet">

        <link href="/css/common.css?time=<?=time();?>" rel="stylesheet"/>
        <style>
            <?php // echo $response -> FontFace;?>
        </style>

        <script src="//cdn.bootcss.com/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>

    <body>
    <?php if(!isset($a)):?>
    <nav id="main_category">
        <div class="main-title">
            <h1>Codekissyoung Blog</h1>
            <div class="search-article">
                <form action="" method="GET">
                <input type="text" name="search_key" value="<?=$search_key?>" placeholder="全站搜索"/>
                    <input type="submit" value="搜索" />
                </form>
            </div>
        </div>
        <?=$category?>
    </nav>

    <?php endif; ?>
    <div id="article">
        <div>
            <?=$html;?>
        </div>
    </div>

    <script src="/js/highlight.pack.js"></script>
    <script>
        // 代码高亮
        hljs.initHighlightingOnLoad();
    </script>

    <script src="/js/common.js"></script>
    <script>
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
                    console.log(href);
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
    </script>
    </body>
</html>
