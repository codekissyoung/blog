<?php
include_once '../config.php';

$host         = $_SERVER["HTTP_HOST"];

$protocol = 'http://';
if( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' )
    $protocol = 'https://';
if( isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')
    $protocol = 'https://';

$current_article = isset($_SERVER['PATH_INFO']) ? $_SERVER["PATH_INFO"] : '';
if( $current_article )
    $article = MD_ROOT."{$current_article}.md";
else
    $article = MD_ROOT.'/link.md';


$title  = trim(join('-',explode("/",$current_article))."-CodeKissYoung Blog",'-');


// 加载文章内容
$parser = new HyperDown\Parser();
$content = is_file( $article  ) ? file_get_contents( $article ) : "文章不存在";
$html   = $parser -> makeHtml( $content );

// 搜索全文
$search_key = isset($_GET['search_key']) ? $_GET['search_key'] : '';
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
            $value                  = htmlentities(str_replace( $matchs[0], '', $value ));
            $value                  = str_replace( $search_key ,'<span class=search_key>'.$search_key.'</span>', $value );
            $html                   = $html."<li class=search-list> $search_article_tag $value </li>";
        }
    }
    $html .= "</ul>";
}

// 视图
if( isset($_GET['ajax']) )
    include_once 'view/article.php';
else
{
    $category = file_tree_print( file_tree( MD_ROOT ) , $current_article );
    include_once 'view/index.php';
}

