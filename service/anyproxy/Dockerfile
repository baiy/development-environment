FROM node:lts

RUN npm config set registry https://registry.npm.taobao.org
RUN npm install -g anyproxy
RUN anyproxy-ca --generate
EXPOSE 8001 8002
CMD anyproxy --intercept --ignore-unauthorized-ssl --ws-intercept --rule=/anyproxy/relu.js

