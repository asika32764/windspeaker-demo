# WindSpeaker

## Create Project

Clone project file

``` bash
$ git clone {PROJECT URL}
$ cd {PROJECT}
$ composer update
```

Add SQL account

```
cp etc/config.dist.yml etc/config.yml
vim config.yml
```

Import SQL

```
php bin/console migration status
php bin/console migration migrate
```

Import test data

```
php bin/console seed import
```

Clean test data

```
php bin/console seed clean
```


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
