#centos 6.5 上安装php,nginx

----------------
##install  php
1. 下载php源码
2. 安装``gcc ,libxml,mysql-devel``
        yum install gcc
        yum install mysql-devel
        yum install libxml2-devel
3. 解压php代码
        ``tar -xzvf php-5.3.28.tar.gz``
        cd php-5.3.28
4. 按照php.net上的方法安装:
        ./configure --enable-fpm --with-mysql

如果提示
``configure: error: Cannot find libmysqlclient under /usr``

则需要软连接,因为mysql编译时是在 ``/usr/lib`` 目录下找 ``libmysqlclient.so``,
就算你指定 ``--with-mysql=/usr/lib64`` 也不行.
        ln -sv /usr/lib64/mysql/libmysqlclient.so /usr/lib/libmysqlclient.so

4.make
5.make install

--------------------
##安装nginx
        ./configure
        make
        sudo make install
启动nginx
        /usr/local/nginx/sbin/nginx




##防火墙
###开发环境干脆关掉防火墙
###关闭
        /etc/init.d/iptables stop
#禁止开机启动
        chkconfig iptables off
