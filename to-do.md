- include 
    - fonction.php
        - get_all_lines
        - dbconnect
        - get onelines
        - get_employe_by_dept
        - get_fiche_employees
        - get_historique_employees
        - get_historique_poste

# version 1
- index.php
    - affichage
        - liste des departements
        - nom manager
        - lien vers liste_employe.php
    - base 
        - employees
    - code 
        - sql 
        - utilisation refactorisation get_all_lines()

- liste_employe.php
    - affichage
        - liste des employes par dept
    - code 
        - utilisation refactorisation get_employe_by_dept ()

# version2
- fiche.php
    - affichage
        - information employes 
        - affichage tableau historique de salaire et emploie
    - code
        - ajout lien sur liste_employe.php
        - utilisation refactorisation get_fiche_employees(),get_historique_employees(), get_historique_poste()

- recherche.php
    - affichage
        - formulaire de recherche

- result-search.php
    - affichage 
        - liste des resultat selon le champ selectionées
        - limit 20 des lignes
        - lien precedent a 20 lignes
        - lien suivant a 20 lignes

    - code 
        - utilisation refactorisation search() 

        - fonction.php
            - search()
                - concatenation des sql si le champ est valide 
            
# version 3 

- index.php 
    - affichage 
        - colonne nb employes
    - code 
        - sql ; et refacto get_all_line()


- nb-employes.php
    - affichage
        - tableau nb employes et salaire moyen

    - code 
        - refactorisation get_all_line() 
        - sql  

- fiche.php 
    - 
        
