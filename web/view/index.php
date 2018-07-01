<!DOCTYPE HTML>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta name="baidu-site-verification" content="PVkQXzqbOU" />
        <title><?=$title?></title>
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link href="/css/normalize.css" rel="stylesheet"/>
        <link href="/css/highlight_styles/github.css" rel="stylesheet">
        <link href="/css/common.css" rel="stylesheet"/>
        <script src="/js/jquery-3.3.1.min.js"></script>
        <script src="/js/highlight.pack.js"></script>
        <script src="/js/main.js"></script>
    </head>
    <body>
        <div id="site-category">
            <div id="site-category-contentd">
                <div id="blog-name">
                    <a href="http://blog.codekissyoung.com">CodekissYoung Blog</a>
                </div>
                <div id="search-article">
                    <form action="" method="GET">
                    <input type="text" name="search_key" value="<?=$search_key?>" placeholder=""/>
                        <input type="submit" value="Search" />
                    </form>
                </div>
            </div>
        </div>
        <div id="site-category-box-fill"></div>
        <div id="article">
            <nav id="main_category">
                <?=$category?>
            </nav>
            <div id="article-category-button">
                <a  href="javascript:void();">目录</a>
            </div>
            <div id="article-content">
                <div>
                    <?=$html;?>
                </div>
            </div>
        </div>
    </body>
</html>
