# Jeu Set et Match

## Installation

We use [WebSocketBundle v1.8.11](https://github.com/GeniusesOfSymfony/WebSocketBundle/tree/v1.8.11) for websocket between Doctrine events, PubSub and Client side.

This is how to start the web server properly :

```bash
# Lauch server for web socket
php bin/console gos:websocket:server

# Create database with fixtures
php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate -n
php bin/console doctrine:fixtures:load -n
```
