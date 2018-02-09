# 字符串长度
```bash
➜  shell git:(master) var=122131213122sfsfsdfd
➜  shell git:(master) echo ${#var}
20
```

# 字符串比较
- `[[ $a==$b ]]`相等
- `[[ $a!=$b ]]`不等
- `[[ $a>$b ]]`字符序大
- `[[ $a>$b ]]`字符序小
- `[[ -z $a ]]`空字符串
- `[[ -n $a ]]`非空字符串
- `if [[ -z $a ]] && [[ -n $b ]]`将多个条件组合起来 

# 测试字符串是否为文件
-b file	是否是块设备文件，如果是，则返回 true。	[ -b $file ] 返回 false。
-c file	是否是字符设备文件，如果是，则返回 true。	[ -b $file ] 返回 false。
-d file	是否是目录，如果是，则返回 true。	[ -d $file ] 返回 false。
-f file	是否是普通文件（既不是目录，也不是设备文件），如果是，则返回 true。	[ -f $file ] 返回 true。
-g file	是否设置了 SGID 位，如果是，则返回 true。	[ -g $file ] 返回 false。
-k file	是否设置了粘着位(Sticky Bit)，如果是，则返回 true。	[ -k $file ] 返回 false。
-p file	是否是具名管道，如果是，则返回 true。	[ -p $file ] 返回 false。
-u file	是否设置了 SUID 位，如果是，则返回 true。	[ -u $file ] 返回 false。
-r file	是否可读，如果是，则返回 true。	[ -r $file ] 返回 true。
-w file	是否可写，如果是，则返回 true。	[ -w $file ] 返回 true。
-x file	是否可执行，如果是，则返回 true。	[ -x $file ] 返回 true。
-s file	是否为空（文件大小是否大于0），不为空返回 true。	[ -s $file ] 返回 true。
-e file	（包括目录）是否存在，如果是，则返回 true。	[ -e $file ] 返回 true。



