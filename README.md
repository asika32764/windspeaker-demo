# WindSpeaker

## Apache Setting

In Server

```
<VirtualHost *:80>
DocumentRoot /var/www/windspeaker/www
ServerName windspeaker.co
ServerAlias *.windspeaker.co
</VirtualHost>
```

In localhsot

``` http
<VirtualHost *:80>
DocumentRoot /var/www/windspeaker/www
ServerName windspeaker.co
ServerAlias *.windspeaker.co
</VirtualHost>

# Asika
<VirtualHost *:80>
DocumentRoot /var/www
ServerName localhost
</VirtualHost>
```

## Hosts Setting

```
127.0.0.1 windspeaker.co asika.windspeaker.co simon.windspeaker.co
```
