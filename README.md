# API Bookmark

Ce projet a pour but de permettre la gestion de marques pages sur des vidéos et images

La récupération des informations sur les images et vidéos est automatisés via le protocole OEmbed

Il est également possible d'ajouter des tags aux liens référencés

## Démarrer le projet

Le projet utilise docker (>= 19.03) et docker-compose (>= 1.24) pour démarrer l'environnement de developpement.  

`docker-compose up -d`

Le projet est accessible sur : http://localhost:8383
 
## Fonctionnement

Pour le fonctionnement de l'api, se référer à la doc swagger : http://localhost:8383/api/doc

## Améliorations

- TU (phpunit) 
- TF (behat)
- Gestion des logs (Monolog sortie stdout/stderr, Beats, ELK)
- Améliorer la doc d'api swagger (exemples, etc)
- Migrer l'api vers la spécification Json-API ou Hydra

