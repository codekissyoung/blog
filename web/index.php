<?php
include_once '../config.php';

// 博客当前访问文章
$ri         = isset($_SERVER['PATH_INFO']) ? $_SERVER["PATH_INFO"] : '';
$search_key = isset($_GET['search_key']) ? $_GET['search_key'] : '';
$host       = $_SERVER["HTTP_HOST"];
$protocol   = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FOR    WARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
if( $ri )
{
    $article = MD_ROOT."{$ri}.md";
}
else
{
    $article = MD_ROOT.'/link.md';
}

// 加载文章内容
if( is_file( $article  ) )
{
    $content = file_get_contents($article);
}
else
{
    $content = "文章不存在"; // 404
}
$parser = new HyperDown\Parser();
$html = $parser -> makeHtml($content);

// 搜索全文
if( $search_key )
{
    $html = "<ul>";
    exec( "grep -inr \"$search_key\" ./md/", $ret_arr, $ret_code );
    if( is_array($ret_arr) )
    {
        foreach( $ret_arr as $key => $value )
        {
            $ret                    = preg_match("/\.\/.*md:/", $value, $matchs );
            $href                   = substr($matchs[0],5,-4);
            $search_article_tag     = "<a href='$protocol$host/$href'>$href</a>&nbsp;";
            $value                  = str_replace( $matchs[0], '', $value );
            $value                  = str_replace( $search_key ,'<span class=search_key>'.$search_key.'</span>', $value );
            $html                   = $html."<li class=search-list> $search_article_tag $value </li>";
        }
    }
    $html .= "</ul>";
}

$title = trim(join('-',explode("/",$ri))."-CodeKissYoung Blog",'-');

// 加载视图
if(isset($_GET['ajax']))
{
    include_once 'view/article.php';
}
else
{
    $category = file_tree_print( file_tree(MD_ROOT) , $ri );
    include_once 'view/index.php';
}

