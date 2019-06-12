FROM node:10

ARG CONTAINER_CHANGE_SOURCE=false

# 更换源
COPY sources.list /etc/apt/china.sources.list
RUN if [ ${CONTAINER_CHANGE_SOURCE} = true ]; then \
	mv /etc/apt/sources.list /etc/apt/source.list.bak && mv /etc/apt/china.sources.list /etc/apt/sources.list \
;fi

# 系统更新
RUN  apt-get -y update && apt-get -y upgrade && apt-get -y dist-upgrade 

# 修改系统时区
ARG CONTAINER_TIME_ZONE=UTC
ENV CONTAINER_TIME_ZONE ${CONTAINER_TIME_ZONE}
RUN ln -snf /usr/share/zoneinfo/$CONTAINER_TIME_ZONE /etc/localtime && echo $CONTAINER_TIME_ZONE > /etc/timezone

# 安装依赖和必要的软件
RUN apt-get install -y --no-install-recommends  vim unzip git wget iputils-ping curl

RUN npm config set registry https://registry.npm.taobao.org
RUN npm install -g anyproxy
RUN anyproxy-ca --generate
EXPOSE 8001 8002
CMD anyproxy --intercept --ignore-unauthorized-ssl --ws-intercept --rule=/anyproxy/relu.js

