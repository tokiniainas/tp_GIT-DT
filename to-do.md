ETU 005023 ETU004956
- include 
    - fonction.php
        - (ok) get_all_lines
        - (ok) dbconnect
        - (ok) get onelines
        - (ok) get_employe_by_dept
        - (ok) get_fiche_employees
        - (ok) get_historique_employees
        - (ok) get_historique_poste
        - (ok) change_departement()
        - (ok) get_id_departement()

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

- liste_employe.php(ok) ETU 005023
    - affichage
        - liste des employes par dept
    - code 
        - utilisation refactorisation get_employe_by_dept ()

# version2
- fiche.php(ok) ETU 005023
    - affichage 
        - information employes 
        - affichage tableau historique de salaire et emploie
    - code
        - ajout lien sur liste_employe.php
        - utilisation refactorisation get_fiche_employees(),get_historique_employees(), get_historique_poste()

- recherche.php(ok) ETU004956
    - affichage
        - formulaire de recherche

- result-search.php(ok) ETU004956
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

- index.php (ok) ETU 005023
    - affichage 
        - colonne nb employes
    - code 
        - sql ; et refacto get_all_line()


- nb-employes.php(ok) ETU004956
    - affichage
        - tableau nb employes et salaire moyen

    - code 
        - refactorisation get_all_line() 
        - sql  

- fiche.php (ok) ETU004956
    - affichage 
        - ajout de l'emploi le plus long 
    - code 
        - sql ; refactorisation get_one_line()


# version 4
- fiche.php 
    - affichage
        - bouton : change departement  (ok) ETU 005023
    - code
        - utilisation de la refactorisation fonction:
            - change_departement()(ok)
            - get_id_departement()

- traitement-change.php
    - affichage 
        - formulaire de changement (ok)ETU 005023

    - code 
        - gestion sql 
        - get_id_departement()
        - gestion d'erreur (en cours)


- fiche.php 
    - affichage (ok ) ETU 004956
        - bouton devenir manager(ok)
        - nom du manager en cours 
        - gestion d'erreur 
    - code  
        - lien formulaire 
        - gestion sql 

- dev-man.php (ok ) ETU 004956
    - affichage
        - formulaire date debut
        - manager en cours
        - submit
    - code 
        - gestion sql 
        - get_emp_no
        - gestion d'erreur (en cours)

    



