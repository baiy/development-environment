## 简介
> 基于docker的开发环境
```
nginx+mysql+redis+anyproxy+grafana
```

## 依赖
* docker
* docker-compose

## 安装过程
```shell
git clone git@github.com:baiy/development-environment.git
cd development-environment
docker-compose up -d
```
> 等待安装结束

## 相关地址
* nginx:http://127.baiy.org/
* anyproxy监控页面:http://anyproxy.127.baiy.org:8002/
* mysql: 127.0.0.1:3306  root root
* grafana: http://grafana.127.baiy.org:3000/  admin admin (该密码为首次登陆密码)

## 其他
进入容器
```
docker-compose exec nginx /bin/bash
```
