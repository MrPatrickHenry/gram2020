FROM padster83/centos7-php7-laravel:latest
MAINTAINER "patrick henry" <docker@patrickhenry.us>

EXPOSE 80 443

CMD ["/usr/sbin/init"]