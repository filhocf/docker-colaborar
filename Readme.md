# Project Colaborar

Colaborar (1) is a iniciative name of a open source projects lab that helps teams to work better, anyway of your goal. It can help people from IT in a DevOps culture, or a management people addopting a lean/agile culture, or any other way that can get people more close in work togheter, even though them are not fisically near.

## Colaborar Environment

Colaborar, actually, is composed by a:
*main site - by Nginx (2)
*webmail client - by Roundcube Mail (3)
*kanban board - by Kanboard (4)
*videoconference system - by Jitsi (5) (not implemented yet)
*collaborative pad - by Etherpad (6) (not implemented yet)
*webcanvas (to products development)- by Webcanvas (7)  (not implemented yet)
*chat system - by RocketChat (8) (not implemented yet)

All in a docker ecosystem.

## How works

The lab require the main address, and for each service need a subdomain, all configured in a unique IP. So, if your main domain is mycompany.com, you can access, with the required DNS configuration, the follow URLs:
*mycompany.com -> main address
*mail.mycompany.com -> webmail client
*kanban.mycompany.com -> online kanban board
*conf.mycompany.com -> webconference
*pad.mycompany.com -> online pad
*canvas.mycompany.com -> online canvas board
*chat.mycompany.com -> online chat for channels and direct rooms

```
                               +-----------+
                        +------| Roundcube |---+
           +-------+    |      +-----------+   |
           |       |    |      +-----------+   |  +------------+
client --> | Nginx | ---+------| Etherpad  |---+--|   MySql    |
           |       |    |      +-----------+      +------------+
           +-------+    |      +-----------+      +------------+
                        +------| Kanboard  |---+--| PostgreSQL |
                        |      +-----------+   |  +------------+
                        |      +-----------+   |
                        +------| Web2Canvas|---+
                        |      +-----------+
                        ...

```

(1) http://https://github.com/filhocf/docker-colaborar

(2) http://nginx.org

(3) http://roundcube.net

(4) http://Kanboard.net

(5)

(6)

(7)

(8)
