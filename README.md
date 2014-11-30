# WindSpeaker

## Apache Setting

### In Server

```
<VirtualHost *:80>
DocumentRoot /var/www/windspeaker/www
ServerName windspeaker.co
ServerAlias *.windspeaker.co
</VirtualHost>
```

### In localhsot

We need a `localhost` VirtualHost to keep localhost still work, otherwise the windspeaker VirtalHost will override localhost.

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

`hosts` file dose not support wildcards (`*`), so we create a record per account.

```
127.0.0.1 windspeaker.co asika.windspeaker.co simon.windspeaker.co
```
