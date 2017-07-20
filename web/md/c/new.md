# 将数组传入函数
- 传入的实际是数组的首地址，然后通过整个地址来访问数组
```c
int str[] = {2,3,4,5,6};
// 定义一
int array_func(int arr[],int size){

}
// 定义二
int array_func2(int *arr,int size){

}
array_func(str,sizeof(str));
array_func2(str,sizeof(str));
```

# 从函数中返回数组
- 在函数内部定义的局部变量不能返回它的地址给函数外部使用，除非它是static 或者是向堆申请的内存
- 想从函数返回一个一维数组，要声明返回指针
```c
int * myFunc(){
	static int arr[10];
	// ...
	return arr;
}
```

# 指向数组的指针
- 将数组名赋值给指针后，可以使用指针来依次访问数组元素
```c
double *p;
double balance[10];
p = balance;
*p; // balance[0];
*(p + 1); // balance[1];
```

# 指针
- 对于任意一个变量，都可以使用`&`来取它的内存地址
- 指针就是用来存放内存地址的一种变量，它有类型的区分，不同类型之间的指针不能相互赋值
```
int a = 19;
printf(" a address : %p \n",&a);

double *dou; // 声明一个double类型指针
```
