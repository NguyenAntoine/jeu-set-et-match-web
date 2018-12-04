#!/bin/bash
set -e
shopt -s nullglob

if [ "$1" = 'apache2-foreground' ]; then
    # initializing web
    for f in /docker-entrypoint-init.d/*; do
        case "$f" in
            *.sh)                  echo "$0: running $f"; . "$f" ;;
            */virtual-host_*.conf) echo "$0: virtual host ${f##*_}"; envsubst < "$f" > /etc/apache2/sites-available/${f##*_} ;;
            *)                     echo "$0: ignoring $f" ;;
        esac
        echo
    done
fi

exec "$@"