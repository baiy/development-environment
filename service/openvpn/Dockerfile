FROM alpine:latest

COPY openvpn-up.sh /usr/local/bin/
COPY entrypoint.sh /usr/local/bin/

RUN echo "http://dl-4.alpinelinux.org/alpine/edge/testing" >> /etc/apk/repositories
RUN apk add --no-cache bash curl wget openvpn openresolv openrc openssl 3proxy
RUN mkdir -p /etc/openvpn
COPY update-resolv-conf /etc/openvpn/
RUN chmod +x \
        /usr/local/bin/openvpn-up.sh \
        /usr/local/bin/entrypoint.sh \
        /etc/openvpn/update-resolv-conf

# OpenVPN Options
ENV     OPENVPN_CONFIG      "/vpn/client.ovpn"
ENV     OPENVPN_UP          ""

# aria2 Options
ENV     ARIA2_PORT          ""
ENV     ARIA2_PASS          ""
ENV     ARIA2_PATH          "."
ENV     ARIA2_ARGS          ""
ENV     ARIA2_UP            ""

# Proxy Options
ENV     PROXY_USER          ""
ENV     PROXY_PASS          ""
ENV     PROXY_UP            ""

# Proxy Ports Options
ENV     SOCKS5_PROXY_PORT   "1080"
ENV     HTTP_PROXY_PORT     "3128"

ENV     DAEMON_MODE         "false"

ENTRYPOINT  [ "entrypoint.sh" ]