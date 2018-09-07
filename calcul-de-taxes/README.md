# Documentation générale!

Dans cette documentation vous trouverez les prérequis a l'utilisation des scripts PHP, ainsi que les commande a utiliser pour lancer les scripts depuis l'invite de commande.


# Prérequis

* PHP 7 installé
* Avoir récupéré les scripts.


## installer PHP 7 

Pour installer PHP, selon le système d'exploitation la marche a suivre étant différente, veuillez vous reporter a la documentation de php ici : http://php.net/manual/fr/install.php

# Utilisation des scripts

Afin de pouvoir utiliser les scripts il faut utiliser l'invite de commande.
Pour mon exemple nous considérerons que nous somme sous Windows 10.

## ouvrir l'invite de commande

Pour ouvrir l'invite de commande, il suffit de cliquer sur  démarrer et de taper "cmd".

La commande pour changer de répertoire est l'abréviation anglaise de Change Directory, soit CD (la commande CHDIR est un synonyme reconnu également).

-   Tapez la commande  **CD**, suivie d'un espace, suivie du chemin complet du répertoire où aller  
    CD C:\répertoire\sous-répertoire\sous-sous-répertoire
-   La commande  **CD..**  (CD suivi de deux points coller à la commande) permet de remonter d'un niveau dans la hiérarchie des répertoires (aller au répertoire parent)  
    CD..
-   Le commande CD suivie de la lettre d'un lecteur (CD lecteur:) permet d'afficher le répertoire courant sur le lecteur  
    CD D:
-   La commande CD seule permet d'afficher le lecteur courant et le répertoire courant sur ce lecteur  
    CD
-   La commande CD suivie du switch /D permet de changer de lecteur et de répertoire. Ainsi, si vous êtes sur le lecteur C:, vous pouvez faire :  
    CD /D E:\répertoire\sous-répertoire\sous-sous-répertoire
-   La commande  **DIR**  permet de lister le contenu du répertoire (liste des fichiers et des noms des sous-répertoires.
-   La commande  **CD**  suivie du nom d'un sous-répertoire du répertoire courant permet de descendre d'un niveau dans la hiérarchie (aller dans un sous-répertoire).

## Exécution du script Calcul de taxes

Une fois dans le dossier `Test_Calcul_Taxes` contenant les scripts `facture.php` et `facture_test.php`.
Exécutez la commande suivante : `php facture.php --help` et laissez vous guider.

## Exécution du script Rendu de monnaie

Une fois dans le dossier `Test_Rendu_Monnaie` contenant les scripts `Change.php`, `optimalChange.php` et `optimalChange_test.php`.
Exécutez la commande suivante : `php optimalChange.php --help` et laissez vous guider.