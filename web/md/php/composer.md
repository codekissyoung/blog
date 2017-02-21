# 安装
http://www.phpcomposer.com/ composer中文镜像网
1. 照着里面文档,先运行脚本下载安装
    ```shell
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    php composer-setup.php
    php -r "unlink('composer-setup.php');"
    ```
2. 变成全局安装
    ```shell
    sudo mv composer.phar /usr/local/bin/composer
    ```
3. 修改安装源
    ```shell
    composer config -g repo.packagist composer https://packagist.phpcomposer.com
    ```
4. 经常更新 保持最新版
    ```shell
    composer selfupdate
    ```
