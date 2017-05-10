# Login Shell
借用《鸟哥的linux私房菜》中的定义：
>取得 bash 時需要完整的登入流程的，就稱為 login shell。舉例來說，你要由 tty1 ~ tty6 登入，需要輸入使用者的帳號與密碼，此時取得的 bash 就稱為『 login shell 』囉；

除过上面获取login shell的方式外，我们还可以通过在non-login shell中运行
`bash --login`来得到一个login shell。
login shell启动时的配置文件读取流程如下
```shell
execute /etc/profile
IF ~/.bash_profile exists THEN
    execute ~/.bash_profile
ELSE
    IF ~/.bash_login exist THEN
        execute ~/.bash_login
    ELSE
        IF ~/.profile exist THEN
            execute ~/.profile
        END IF
    END IF
END IF
```
当我们退出或者注销login shell时，也有需要执行如下流程：
```shell
IF ~/.bash_logout exists THEN
    execute ~/.bash_logout
END IF
```

# Non-Login Shell
借用《鸟哥的linux私房菜》中的定义：
>取得 bash 介面的方法不需要重複登入的舉動，舉例來說，(1)你以 X window 登入 Linux 後， 再以 X 的圖形化介面啟動終端機，此時那個終端介面並沒有需要再次的輸入帳號與密碼，那個 bash 的環境就稱為 non-login shell了。(2)你在原本的 bash 環境下再次下達 bash 這個指令，同樣的也沒有輸入帳號密碼， 那第二個 bash (子程序) 也是 non-login shell 。
譬如在Ubuntu中，我们启动的Gnome Terminal，在默认情况下就是一个non-login shell。non-login shell启动时的配置文

件读取流程：
```
execute /etc/bash.bashrc
IF ~/.bashrc exists THEN
    execute ~/.bashrc
END IF
```
