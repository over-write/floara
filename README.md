# floara
It's just sample for php use Floara on Heroku. 

## set up database

```
$ heroku addons:add cleardb:ignite
```
And create table!
```
create table page (id int primary key auto_increment,body text, update_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP );
insert into page values (1, '<tr><th>エリア</th><th>店名</th><th>開店時間</th></tr><tr><td>東京</td><td>かつ屋</td><td style="text-align: center">10時〜22時</td></tr><tr><td>名古屋</td><td>吉野家</td><td style="text-align: center">24時間営業</td></tr><tr><td>大阪</td><td>ゴーゴーカレー</td><td style="text-align: center">9時〜24時</td></tr><tr><td>神戸</td><td>らんぷ亭</td><td style="text-align: center">24時間営業</td></tr>', now());
```