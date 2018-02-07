define(['highlight'],function( hljs ){
    // 代码高亮
    hljs.initHighlightingOnLoad();
    return {
        log:function(){
            console.log("hljs complete!");
        }
    };
});
