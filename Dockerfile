FROM duckll/lnmp
LABEL maintainer="jerrymxy"

# 拷贝后端程序
ADD ./todolist_php/ /home/wwwroot/default/todolist/
# 拷贝前端部分
ADD ./todolist_vue/ /home/wwwroot/todolist_vue/
ADD ./todolist.sql /home/
# 设置容器时间，有的容器时区与我们的时区不同，可能会带来麻烦
# RUN cp /usr/share/zoneinfo/Asia/Shanghai /etc/localtime && echo 'Asia/Shanghai' >/etc/timezone 
# 设置语言为utf-8
ENV LANG C.UTF-8
# 暴露端口
EXPOSE 3306
EXPOSE 8080
EXPOSE 80
EXPOSE 443
WORKDIR /home/wwwroot/todolist_vue/
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt install nodejs
RUN npm install --registry=http://registry.npmmirror.com
# RUN npm run serve

# RUN mysql -uroot -proot < /home/todolist.sql
