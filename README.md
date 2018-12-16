Projet Jeu Set et Match
=======

Ceci est un projet pour mettre en place l'affichage de résultats 
d'un match de tennis en temps réel.

## Technologies

- PHP 7.1
- Apache 2.4
- mySQL 5.5
- Symfony 3.4
- Composer 1.6
- Npm 4.2
- Yarn 1.3

## Déploiement par Docker

Remarque : Vous devez avoir Docker

### Avoir son propre environnement de développement

Create the `.env` file from [.env.dist](.env.dist) example with the
environment variables from [docker let's encrypt nginx proxy](https://github.com/JrCs/docker-letsencrypt-nginx-proxy-companion/wiki/Basic-usage)

Pour avoir une composition de l'application,
vous devez utiliser la commande suivant dans la répertoire 
[jeu-set-et-match-web](/):

```bash
$ docker-compose up -d
```

### Update docker images

```bash
./updateDockerImages.sh
```

### Image apache

On utilise une image php7.1.2-apache personnalisée

### Image mySQL

On utilise une image mysql5.7 personnalisée

### Image phpmyadmin

Contacter antoine.nguyen3@epsi.fr pour tout renseignement.
