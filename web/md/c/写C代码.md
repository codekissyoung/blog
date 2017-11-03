# goto
- 用在错误处理

```c
retval = request_irq(IRQ_EINT(20), buttons_interrupt, IRQF_DISABLED,
     "KEY1", (void *)EINT_DEVICE_ID);
if(retval){
    err("request eint20 failed");		
    return error;
}

/* Driver register */
major = register_chrdev(major, DRIVER_NAME, &key_fops);
if(major < 0){
    err("register char device fail");
    free_irq(IRQ_EINT(20), (void *)EINT_DEVICE_ID);
    retval = major;
    return retval;
}
key_class=class_create(THIS_MODULE,DRIVER_NAME);
if(IS_ERR(key_class)){
    err("class create failed!");
    free_irq(IRQ_EINT(20), (void *)EINT_DEVICE_ID);
    unregister_chrdev(major, DRIVER_NAME);
    retval =  PTR_ERR(key_class);
    return retval;
}
key_device=device_create(key_class,NULL, MKDEV(major, minor), NULL,DRIVER_NAME);
if(IS_ERR(key_device)){
    err("device create failed!");
    free_irq(IRQ_EINT(20), (void *)EINT_DEVICE_ID);
    unregister_chrdev(major, DRIVER_NAME);
    class_destroy(key_class);
    retval = PTR_ERR(key_device);
    return error_device;
}
```

看到了吗.因为每一步的错误处理需要把之前申请或注册成功的资源全部都释放掉,比如class_create失败需要注销irq和驱动(因为它们已经成功了,到这一步失败了,那么之前的成功就没有意义了,所以因为一切要恢复到最初的样子),所以这会产生大量重复的代码,free_irq这个函数写了三次,unregister_chrdev写了二次


```c
retval = request_irq(IRQ_EINT(20), buttons_interrupt, IRQF_DISABLED,"KEY1", (void *)EINT_DEVICE_ID);
if(retval){
    err("request eint20 failed");
    goto error;
}
/* Driver register */
major = register_chrdev(major, DRIVER_NAME, &key_fops);
if(major < 0){
    err("register char device fail");
    retval = major;
    goto error_register;
}
key_class=class_create(THIS_MODULE,DRIVER_NAME);
if(IS_ERR(key_class)){
    err("class create failed!");
    retval =  PTR_ERR(key_class);
    goto error_class;
}
key_device=device_create(key_class,NULL, MKDEV(major, minor), NULL,DRIVER_NAME);
if(IS_ERR(key_device)){
    err("device create failed!");
    retval = PTR_ERR(key_device);
    goto error_device;
}
__debug("register myDriver OK! Major = %d\n", major);
return 0;

error_device:
    class_destroy(key_class);
error_class:
    unregister_chrdev(major, DRIVER_NAME);
error_register:
    free_irq(IRQ_EINT(20), (void *)EINT_DEVICE_ID);
error:
    return retval;
}
```

# 短路计算
- 不用if语句，不用汇编，怎么使得两数之积总是小于等于255?
```c
result   = ((a*b) > 255) ? 255 : a*b; // 方法 1
bool tmp = ((result = a*b) < 255) || (result=255); // 方法 2
bool tmp = ((result = a*b) >= 255) && (result=255); // 方法 3
```

# 精简while
```c
while( scanf("%ld",&num) == 1 )     // 获取值和判断都成功
while(( ch = getchar()) != '\n')    // 注意 () 不能省，!= 优先级高
while( * string )                   // 判断空字符串
```
# 三目运算符
```
max = (a > b) ? a : b; // 若判断为真 , 则整个语句结果为 a 表达式计算的值 , 反之为b
```

# 将数组传入函数
```c
int str[] = {2,3,4,5,6};
int array_func(int arr[],int size); // 定义一
int array_func2(int *arr,int size); // 定义二
array_func(str,sizeof(str));
array_func2(str,sizeof(str));
```

# 从函数中返回数组
- 在函数内部定义的局部变量不能返回它的地址给函数外部使用，除非它是static 或者是向堆申请的内存
- 想从函数返回一个一维数组，要声明返回指针
```c
int* myFunc(){
	static int arr[10];
	// ...
	return arr;
}
```

# 使用指针操作数组
```c
double *p;
double balance[10];
p = balance;    // 将 数组首地址 赋值给 指针
*p;             // balance[0];
*(p + 1);       // balance[1];
```
