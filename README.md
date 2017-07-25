# floara
It's just sample for php use Floara on Heroku. 

## set up database

```
$ heroku addons:add cleardb:ignite
```
And create table!
```
create table page (id int primary key auto_increment,body text, update_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP );
insert into page values (1, '', now());
```