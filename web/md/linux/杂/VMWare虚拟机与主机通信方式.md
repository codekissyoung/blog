## 1、Bridged方式 ##

```
虚拟系统的IP可以设置成与本机系统在同一个网段，虚拟机相当于网络内部一个独立的机器，
与本机共同插在一个Hub上，网络内的其他机器可以访问虚拟机，虚拟机也可以访问网络内其
他机器，当然与本机的互访也不成问题。
主机拔掉网线后，虚拟机无法与主机通过网络的方式进行通讯。
```
## 2、NAT方式（需要用vmnet8） ##

```
使用VMware提供的NAT和DHCP服务，虚拟机使用主机中过的虚拟网卡Vmnet8作为网关，这种
方式可以实现主机和虚拟机通信，虚拟机也能够访问互联网，但是互联网不能访问虚拟机。
 
只需要设置虚拟机的网络为DHCP，就可以ping通Vmnet8了。
 
也可以手动设置IP，ip设置与vmnet8同网段,gateway，netmask，broadcast设置与vmnet8
相同,dns设置与主机相同。
 
如果使用NAT方式：确保Eidt-Virtual Network Editor中的DHCP处于Start状态
```
## 3、host-only方式（需要用vmnet1） ##

```
只能进行虚拟机和主机之间的网络通信，虚拟机不能访问外部网络。
 
将虚拟机ip设置与vmnet1同网段,gateway设置成vmnet1的ip,其余设置与vmnet1相同,dns设置与主机相同
 
```
对于所有的联网方式：注意关闭防火墙

参考：http://www.cqeis.com/news_detail/newsId=1477.html 