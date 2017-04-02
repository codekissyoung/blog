# 精简while
```c
status = scanf("%ld",&num);
while(status == 1){
    // code
    status = scanf("%ld",&num);
}
```
精简为
```c
while(scanf("%ld",&num) == 1){ // 获取值和判断都成功
    // code
}
```
# 表达式合并
注意`()`不能省，`!=`优先级高
```c
while(( ch = getchar()) != '\n'){

}
```


# 常量在左
```c
if( 5 == num)
```

# 选择循环
- 对于需要计数的或者初始化条件的，比如`++num;` 选用`for`循环
- 对于先行判断是否要执行的,选择`while(){}`
- 对于依据代码执行，判断是否要退出的,使用`do{}while();`

# 三目运算符
`(a > b) ? a : b;`若判断为真,则整个语句结果为a表达式计算的值,反之为b
```
max = (a > b) ? a : b; // 获取较大值
```
