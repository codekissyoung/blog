```c
EXIT_SUCCESS /* 正确退出　, main函数结尾常用：　return EXIT_SUCCESS;*/
EXIT_FAILURE /* 错误退出　*/
```

# 字符串函数
```c
// 拷贝, n 最大值
char *strncpy(char * s1,const char * s2,size_t n);

// 拼接, n 最大值
char *strncat(char * s1,const char * s2,size_t n);

// 比较 n 前几个字符串
int strncmp(const char *s1,const char *s2,size_t n);

// 字符串中查找字符c
int *strchr(const char *s,char c);
int *strrchr(const char *s,char c); // 最后出现c

// s1 包含　s2　中任意字符
char *strpbrk(const char *s1,const char *s2);

// s1包含s2
char *strstr(const char *s1,const char * s2);

// 字符串长度
size_t strlen(const char *s);
```
