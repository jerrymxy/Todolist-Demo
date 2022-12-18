# Todolist-Demo

基于PHP + Vue 2 + MariaDB/MySQL的待办事项Demo

## 运行环境

目标环境：PHP 7.4 + Vue 2 + MariaDB 10.4

测试的最低环境：PHP 5.6 + Vue 2 + MySQL 5.6

Vue CLI需要Node.js版本 >= 14

### XAMPP/LNMP等环境下部署

1. 将todolist_php文件夹下内容复制进nginx/Apache设置的网站根目录下
2. 向MySQL/MariaDB导入todolist.sql
3. 根据MySQL/MariaDB的设置修改databaseinfo.php中的内容
4. 进入todolist_vue文件夹，在终端输入以下命令后运行前端

```sh
npm install
npm run serve
```

### 使用Docker部署

根目录下有编写好的Dockerfile，终端输入以下命令安装并打开容器

```sh
docker build . -t todolist_docker
docker run -idt --name todolist_webserver -p 80:80 -p 8080:8080 todolist_docker
```

打开容器后在容器终端内输入以下指令导入sql、编译前端即可。

```sh
mysql -uroot -proot < /home/todolist.sql
cd /home/wwwroot/todolist_vue/
npm run serve
```

## Credit

前端部分的UI样式根据尚硅谷Vue教程内的示例修改而来
