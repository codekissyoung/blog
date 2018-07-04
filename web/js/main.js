// 代码高亮
hljs.initHighlightingOnLoad();

$(function(){

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
                $("#article-content").empty().append($(data)).find('pre code').each(function(i,block){
                    hljs.highlightBlock(block);
                });
                var title = href;
                var newUrl = href;
                history.pushState({},title,newUrl);
            }
        });
        return false; // 阻止冒泡 阻止事件
    });

    // 目录折叠
    $("#main-category-content>ul h2").on('click',function () {
        if($(this).next().hasClass('hide')){
            $(this).next().removeClass('hide').hasClass('show');
        }else{
            $(this).next().removeClass('show').addClass('hide');
        }
    });

    // 点击显示目录
    $("#article-category-button").on("click",function(){
        $('#main_category').animate({width:'toggle'},300);
    });

    // 鼠标移出目录div
    $("#main_category").on( "mouseleave", function(){
        // $('#main_category').animate({width:'toggle'},300);
    });

    // 目录高度的动态变化
    $("#main_category").css("height",$(window).height() - 152 + 'px');
    $(window).on('resize',function(){
        $("#main_category").css("height",$(window).height() - 152 + 'px');
    });

    $(window).scroll(function(){
        var topp = $(document).scrollTop();
        
        // 目录两个字的 top 的变化
        var top = topp + 20;
        $("#article-category-button").css("top",top + "px");

        // 目录 div 本身的变化
        var div_top = topp;
        // 为了解决在移动超过 10px 时， 目录 div 没有对其顶部的 bug
        if( topp >= 10 )
            div_top = topp - 10;
        $("#main_category").css("top",div_top + "px");
    });
});
