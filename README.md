![Test Image 1](https://www.oabgame.com.br/game/img/logo.png)
<br><br>
Passe na OAB estudando com esse Jogo Incrível!
<br><br>
https://www.oabgame.com.br
<br><br>
Problemas e sugestões devem ser cadastrados aqui: https://github.com/BrunoSette/oabgame/issues

[![buddy pipeline](https://app.buddy.works/brunosette/oabgame/pipelines/pipeline/176427/badge.svg?token=3447326fa1f8563114e93ec824a4fd877ef500ad684ce4e4c7dde26d1f0d3391 "buddy pipeline")](https://app.buddy.works/brunosette/oabgame/pipelines/pipeline/176427)
![Test Image 1](https://img.shields.io/website/https/www.oabgame.com.br.svg?down_color=lightgray&down_message=Offline&style=flat-square&up_color=blue&up_message=Online)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/f78064c74c3b4e44af65c65c93482f92)](https://www.codacy.com?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=BrunoSette/oabgame&amp;utm_campaign=Badge_Grade)


## Prerequisitos

Istalação do Docker e Docker Compose

### Docker For Mac

Download here: https://download.docker.com/mac/stable/Docker.dmg

### Docker For Windows

Download here: https://download.docker.com/win/stable/Docker%20for%20Windows%20Installer.exe

### Testing your Docker Installation 

Ensure your versions of docker, docker-compose, and docker-machine are up-to-date and compatible with Docker.app. Your output may differ if you are running different versions.

````
$ docker --version
Docker version 18.09, build c97c6d6

$ docker-compose --version
docker-compose version 1.24.0, build 8dd22a9

$ docker-machine --version
docker-machine version 0.16.0, build 9ba6da9
````

## Versão para Produção

Baixar a versão no Git

```git clone git@github.com:BrunoSette/oabgame.git```

Rodar o Docker Compose

```docker-compose up -d```

## Versão para Desenvolvimento Local

Baixar a versão no Git

```git clone https://github.com/BrunoSette/oabgame.git```

Alterar a Brach para a LocalDev

```git checkout LocalDev```

Rodar o Docker Compose

```docker-compose up -d```

## Local Address:

* [Website](http://localhost:8100) - Oab Game Website 
* [Mysql Server](http://localhost:9906) - Dependency Management
* [Adminer](http://localhost:8080/) - Adminer server



