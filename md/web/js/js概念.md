# 上下文
函数是一直处于上下文中的，这里的上下文指的就是js对象
js浏览器中，window 对象就是最大的，从定义函数的地方开始往外推，碰见的第一个对象，就是它的上下文。通过在 函数中alert(this); 来判断处于哪个对象中！函数中能操作的属性和能调用的方法都是该上下文的！
#对象的属性
在对象中定义的 变量 即为 对象的属性。
比如 ，在浏览器中，var color="red";alert(this.color);

# 作用域
js只有函数作用域，没有块作用域
```javascript
function a(){
    if(1 == 1){
        var b = "i am b";
    }
    for(var c = 0;c<2;c++){
        var d = "i am d";
    }
    console.log(b); //i am b
    console.log(c); //2
    console.log(d); //i am d
}
a();
```

# 没有重载
重载：为同一个函数名，编写不同的定义，根据参数决定调用的函数！
js 没有重载，因为 js 是不检查参数的。后面的同名函数直接覆盖掉前面的！
# CMD
https://github.com/seajs/seajs/issues/242
# AMD
