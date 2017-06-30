输入重定向
================================================================================
```bash
#!/bin/bash
# 在workspace目录下面查找 read.sh , 错误输出重定向到标准输出，然后再一起重定向到find.log
find /home/cky/workspace read.sh > find.log 2>&1
find /home/cky/workspace read.sh >& find.log　# 同上面功能一样　简写版
```


格式化打印
================================================================================
```bash
#!/bin/bash
printf "%-5s %-18s %-4s\n" NO Name Mark
printf "%-5s %-18s %-4.2f\n" 1 codekissyoung 11.07
printf "%-5s %-18s %-4.2f\n" 2 caokaiyan 12.09
printf "%-5s %-18s %-4.2f\n" 3 "yan code" 01.23
```


彩色字体输出
================================================================================
```bash
#!/bin/bash  
#  
#下面是字体输出颜色及终端格式控制  
#字体色范围：30-37  
echo -e "\033[30m 黑色字 \033[0m"  
echo -e "\033[31m 红色字 \033[0m"  
echo -e "\033[32m 绿色字 \033[0m"  
echo -e "\033[33m 黄色字 \033[0m"  
echo -e "\033[34m 蓝色字 \033[0m"  
echo -e "\033[35m 紫色字 \033[0m"  
echo -e "\033[36m 天蓝字 \033[0m"  
echo -e "\033[37m 白色字 \033[0m"  
#字背景颜色范围：40-47  
echo -e "\033[40;37m 黑底白字 \033[0m"  
echo -e "\033[41;30m 红底黑字 \033[0m"  
echo -e "\033[42;34m 绿底蓝字 \033[0m"  
echo -e "\033[43;34m 黄底蓝字 \033[0m"  
echo -e "\033[44;30m 蓝底黑字 \033[0m"  
echo -e "\033[45;30m 紫底黑字 \033[0m"  
echo -e "\033[46;30m 天蓝底黑字 \033[0m"  
echo -e "\033[47;34m 白底蓝字 \033[0m"  
  
#控制选项说明  
#\033[0m 关闭所有属性  
#\033[1m 设置高亮度  
#\033[4m 下划线  
echo -e "\033[4;31m 下划线红字 \033[0m"  
#闪烁  
echo -e "\033[5;34m 红字在闪烁 \033[0m"  
#反影  
echo -e "\033[8m 消隐 \033[0m "  
  
#\033[30m-\033[37m 设置前景色  
#\033[40m-\033[47m 设置背景色  
#\033[nA光标上移n行  
#\033[nB光标下移n行  
echo -e "\033[4A 光标上移4行 \033[0m"  
#\033[nC光标右移n行  
#\033[nD光标左移n行  
#\033[y;xH设置光标位置  
#\033[2J清屏  
#\033[K清除从光标到行尾的内容  
echo -e "\033[K 清除光标到行尾的内容 \033[0m"  
#\033[s 保存光标位置  
#\033[u 恢复光标位置  
#\033[?25| 隐藏光标  
#\033[?25h 显示光标  
echo -e "\033[?25l 隐藏光标 \033[0m"  
echo -e "\033[?25h 显示光标 \033[0m" 
```

# tee 将stdin复制一份
- 它只能复制上一个命令的stdout,而忽视stderr,除非`2>&1`
- 下列命令，`tee`将`cat`的stdout输出复制到out.txt,同时`cat`的stdout和stderr的输出都传给了下一个管道
- `-a` 选项是追加，不加的话，每次会覆盖文件的值
```bash
cat a* | tee -a out.txt | cat -n
```

# 自定义文件描述符的使用
```bash
cky@cky-pc:~/workspace/shell$ exec 3<input.txt
-bash: input.txt: 没有那个文件或目录
cky@cky-pc:~/workspace/shell$ echo "test input" > input.txt
cky@cky-pc:~/workspace/shell$ exec 3<input.txt # 定义文件描述符3 (读取)
cky@cky-pc:~/workspace/shell$ cat <&3 # 使用
test input

cky@cky-pc:~/workspace/shell$ exec 4>output.txt  # 创建 截断写入模式 文件描述符
cky@cky-pc:~/workspace/shell$ echo "test file disc 4" >&4 # 使用
cky@cky-pc:~/workspace/shell$ cat output.txt 
test file disc 4

cky@cky-pc:~/workspace/shell$ exec 5>> input.txt # 创建 追加写入模式 文件描述符
cky@cky-pc:~/workspace/shell$ echo "file disc 5 test" >&5 # 使用
cky@cky-pc:~/workspace/shell$ cat input.txt 
test input
file disc 5 test
```

`-` 作为stdin文本的文件名
================================================================================
```bash
cky@cky-pc:~/workspace/shell$ echo 'text from stdin' | cat hi.txt -
hi code!
text from stdin
```




















