# 子shell
```bash
#!/bin/bash
count=$(ls | cat -n | wc -l)
echo "共有$count个子文件"

(cd /bin; ls | wc -l); # () 产生一个子进程，子进程不会对当前shell有任何影响

count2=`ls | cat -n | wc -l` # 与 $() 相同
echo "count2 : $count2";

out="$(cat text.txt)" # 使用"号的子进程，会保留空格和换行符。。。。貌似没用啊
echo $out

# cky@cky-pc:~/workspace/shell$ ./son_shell.sh 
# 共有51个子文件
# 167
# count2 : 51
# 1 2 3
```
