# css 书写规范
-  谨慎添加新的选择符规则，尤其不可滥用 id，尽可能继承和复用已有样式
-  选择符、属性、值均用小写（格式的颜色值除外），缩写的选择符名称须说明缩写前的全称，例如 .cl -> Clearfix
-  勿使用冗余低效的 CSS 写法，例如：ul li a span{... }
-  慎用 !important
-  建议使用具有语义化的classname或id
-  避免使用兼容性不好的滤镜
-  开发过程中的未定事项，须用 [!] 标出，以便于后续讨论整理。
-  注释格式，统一使用双斜杠加*。
-  上下模块之间的间距统一使用下一个模块的margin-top来实现，好处是：如果没有下一个模块也不会多出一段空隙。

-  具有特定意义的请勿直接占用
    ```
    hover，selected，disabled，current
    ```

-  不要使用 @import
-  避免使用各种CSS Hack，如需对 IE 进行特殊定义
    ```
    -  _          IE6
    2. *          IE6/7
    3. !important IE7/Firefox
    4. *+         IE7
    5. \9         IE6/7/8
    6. \0         IE8
    7. 条件hack
    <!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]--> IE7以下版本
    <!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"><![endif]--> IE7
    <!--[if IE 8]> <html class="no-js lt-ie9"><![endif]--> IE8
    <!--[if gt IE 8]><!--><html class="no-js"><!--<![endif]--> IE8以上
    ```

-  属性书写顺序,按照元素模型由外及内，由整体到细节书写，大致分为五组：
    ```
    位置：position,left,right,float
    盒模型属性：display,margin,padding,width,height
    边框与背景：border,background
    段落与文本：line-height,text-indent,font,color,text-decoration,...
    其他属性：overflow,cursor,visibility,...
    ```
- 针对特殊浏览器的属性，应写在标准属性之前，例如：
    ```
    -webkit-box-shadow:...;
    -moz-box-shadow:...;
    box-shaow:...;
    ```


# 注释风格
```css
/*　首页样式
--------------------------------------------------------------------------------------------------- */
```

# a 链接样式顺序
书写顺序 L-V-H-A
```
:link :visited :hover :active
```
