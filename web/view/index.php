<!DOCTYPE HTML>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta name="baidu-site-verification" content="PVkQXzqbOU" />
        <!-- 移动浏览器相关设置 -->
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> -->
        <title><?=$title?></title>
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

        <link href="/css/bootstrap/bootstrap.min.css" rel="stylesheet" >
        <link href="/css/highlight_styles/github.css" rel="stylesheet">
        <link href="/css/common.css" rel="stylesheet"/>
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

        <script src="/js/jquery-3.3.1.min.js"></script>
        <script src="/js/bootstrap/bootstrap.min.js"></script>
        <script src="/js/highlight.pack.js"></script>
        <script src="/js/common.js"></script>
    </body>
</html>
