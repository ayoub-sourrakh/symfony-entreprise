<?php 
/*

https://twig.symfony.com/doc/3.x/ (Pour la liste complète)

{{ ... }}   : pour un affichage
{% ... %}   : pour un traitement
{# ... #}   : pour un commentaire

{{ path('accueil') }} // Pour faire un lien
{{ asset('css/style.css') }} // Pour faire un chemin (pointe dans public)

{{ dump() }}    : "équivalent" au var_dump()
- Dans un comtroller : dd()

Affichages :
------------
{{ variable }}                  : Affiche la valeur d'une variable.
{{ tableau.index }}             : Affiche la valeur d'un élément d'un tableau.
{% bloc %} ... {% endbloc %}    : Définit un bloc de contenu réutilisable.

Boucles :
---------
{% for item in collection %} ... {% endfor %}   : Boucle sur une collection d'éléments.
{% for key, value in array %} ... {% endfor %}  : Boucle sur un tableau associatif en accédant à la clé et à la valeur.
{% for i in 1..10 %} ... {% endfor %}           : Boucle avec une plage de valeurs.

Conditions :
------------
{% if condition %} ... {% elseif condition %} ... {% else %} ... {% endif %}    : Structure conditionnelle.
{% if variable is defined %} ... {% endif %}                                    : Vérifie si une variable est définie.
{% if variable is empty %} ... {% endif %}                                      : Vérifie si une variable est vide.

Filtres :
---------
{{ variable|default('valeur par défaut') }} : Utilise une valeur par défaut si la variable est vide.
{{ variable|length }}                       : Renvoie la longueur d'une chaîne, d'un tableau ou d'une collection.
{{ variable|upper }}                        : Convertit une chaîne en majuscules.
{{ variable|lower }}                        : Convertit une chaîne en minuscules.
{{ variable|capitalize  }}                  : Première lettre en majuscule.
{{ variable|date('d/m/Y') }}                : Formate une date selon un format spécifié.
{{ variable|raw }}                          : Pour afficher le code html présent dans la variable

*/