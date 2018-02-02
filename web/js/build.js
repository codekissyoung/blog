({
    appDir              :       './',
    dir                 :       'js-build',
    baseUrl             :       './',
    fileExclusionRegExp :       '/^(r|build)\.js|.*\.scss$/',
    mainConfigFile      :       "main.js", // 直接使用 main.js 中 require.config 的 paths 和 shim 值
    optimize            :       'none',
    optimizeCss         :       'none',
    cssImportIgnore     :       null,
    modules:[
        { name : 'article' },
        { name : 'code_highlight' },
    ],
})
