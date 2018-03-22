FROM nginx:1.12.2

ARG CONTAINER_CHANGE_SOURCE=false

# 更换源
COPY sources.list /etc/apt/china.sources.list
RUN if [ ${CONTAINER_CHANGE_SOURCE} = true ]; then \
	mv /etc/apt/sources.list /etc/apt/source.list.bak && mv /etc/apt/china.sources.list /etc/apt/sources.list \
;fi

# 系统更新
RUN  apt-get -y update && apt-get -y upgrade && apt-get -y dist-upgrade 
RUN apt-get install -y --no-install-recommends libpng-dev libjpeg-dev libxml2-dev libjpeg62-turbo-dev libfreetype6-dev cron vim unzip git wget iputils-ping curl 
# 设置容器时区
ARG CONTAINER_TIME_ZONE=UTC
ENV CONTAINER_TIME_ZONE ${CONTAINER_TIME_ZONE}
RUN ln -snf /usr/share/zoneinfo/$CONTAINER_TIME_ZONE /etc/localtime && echo $CONTAINER_TIME_ZONE > /etc/timezone