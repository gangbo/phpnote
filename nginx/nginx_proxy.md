nginx 配置反向代理

```

upstream google {
#    server 74.125.239.50;
    server www.google.com;
}
server
{
   # listen 80;
    listen 443;
    server_name proxy.local;
    index index.html index.htm index.php default.html default.htm default.php;
    root /home/gangbo/www/proxy;
    ssl on;
    ssl_certificate server.crt;
    ssl_certificate_key server.key;

    ssl_session_timeout 5m;

    location / {
        #proxy_redirect off;
        proxy_redirect https://www.google.com/ /;
        #proxy_set_header Host $host;
        proxy_set_header Host "www.google.com";
        #proxy_set_header Host $http_host;
        proxy_pass http://google;
        proxy_set_header  x-real-IP  $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header Accept-Encoding "identity";
        sub_filter 'www.google.com' 'proxy.local';
        sub_filter 'Gmail' 'proxy' ir;
        sub_filter_once off;
    }

    error_log /var/log/nginx/daigb.access.log;
    access_log /var/log/nginx/daigb.access.log;
}

```
