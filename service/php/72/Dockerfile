FROM php:7.2.3-fpm

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
RUN apt-get install -y --no-install-recommends libpng-dev libjpeg-dev libxml2-dev libjpeg62-turbo-dev libfreetype6-dev cron vim unzip git wget iputils-ping curl 

# PHP扩展安装
RUN docker-php-ext-configure gd --with-freetype-dir --with-jpeg-dir
RUN docker-php-ext-install gd pdo pdo_mysql mysqli soap exif
# 下载地址 https://pecl.php.net/package/redis
COPY redis-4.0.0.tgz /home/redis.tgz
RUN pecl install /home/redis.tgz && docker-php-ext-enable redis

# composer
# 下载地址 https://getcomposer.org/composer.phar
COPY composer.phar /usr/local/bin/composer
RUN chmod 755 /usr/local/bin/composer
RUN if [ $CONTAINER_CHANGE_SOURCE = true ]; then \
	composer config -g repo.packagist composer https://packagist.phpcomposer.com \
;fi