# NATURE DU PROJET :
### Projet personnel, construit avec Symfony 4 ; c'est un blog de voyage qui faisait partie des objectifs de ma césure.
### Ce projet a fait l'objet d'une évaluation par mon école (IIM - Paris) dans le cadre de mon admission en A3 au terme d'une année de césure.

# Installation

## Prérequis
### Utiliser PHP  7.1
### Avoir installé Composer
### Avoir installé Node.js
### Avoir installé le Yarn package manager

## Etapes
### > Git clone
### > Configurer le .env (identifiants de connexion à la base de donnée)
### > Installer les dépendances de Symfony avec :
```
$ composer install
```
### > Installer Webpack Encore avec :
```
$ yarn add --dev @symfony/webpack-encore
```
### > Créer les tables de la base de données avec :
```
$ php bin/console doctrine:migrations:migrate
```
### > Lancer le serveur dans une console via :
```
$ php bin/console server:run
```
#### (Attention, certains anti-virus peuvent entrer en conflit avec le serveur local)
### > Dans une autre console, créer le fichier manifest.json pour la compilation des assets via : 
```
$ yarn encore dev
```
### > Ouvrir une page sur le port 8000
