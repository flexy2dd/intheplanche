# Documentation générale

Dans cette documentation vous trouverez les prérequis a l'utilisation des scripts PHP, ainsi que les commande a utiliser pour lancer les scripts depuis l'invite de commande.

# Prérequis

* PHP 7 installé
* GIT installé
* Avoir récupéré les scripts.

## installer PHP 7 

Pour installer PHP, selon le système d'exploitation la marche a suivre étant différente, veuillez vous reporter a la documentation de php ici : http://php.net/manual/fr/install.php

## installer GIT 
Pour installer GIT, selon le système d'exploitation la marche a suivre étant différente, veuillez vous reporter a la documentation de GIT ici : https://git-scm.com/downloads

# Recuperation des scripts

Pour recuperer les scripts vous devez dans un terminal effectuer la commande **git clone https://github.com/flexy2dd/intheplanche.git**

# Utilisation des scripts

Afin de pouvoir utiliser les scripts il faut utiliser l'invite de commande.
Pour mon exemple nous considérerons que nous somme sous Debian (Jessie ou Stretch).

## ouvrir l'invite de commande

Pour ouvrir l'invite de commande, il suffit de cliquer sur  démarrer et de taper "cmd".

La commande pour changer de répertoire est l'abréviation anglaise de Change Directory, soit cd.

-   Tapez la commande  **cd**, suivie d'un espace, suivie du chemin complet du répertoire où aller  
    cd \répertoire\sous-répertoire\sous-sous-répertoire
-   La commande  **cd ..**  (cd suivi de deux points separés de la commande par un espace) permet de remonter d'un niveau dans la hiérarchie des répertoires (aller au répertoire parent)  
    cd ..

La commande pour lister le contenu d'un repertpoire est ls.

-   Tapez la commande  **ls**, suivie d'un espace, suivie du chemin complet du répertoire a lister
    ls \répertoire\sous-répertoire\sous-sous-répertoire
-   La commande  **cd** seule permet de lister le repertoire courant  
    ls

## Exécution du script Rendu de monnaie

Une fois dans le dossier `intheplanche/calcul-de-taxes` contenant le script `taxe.php` et le repertoire `Taxe`.
Exécutez la commande suivante : `php taxe.php --help` et laissez vous guider.

## Exécution du script Calcul de taxes

Une fois dans le dossier `intheplanche/rendu-de-monnaie` contenant les scripts `change.php`.
Exécutez la commande suivante : `php change.php --help` et laissez vous guider.
