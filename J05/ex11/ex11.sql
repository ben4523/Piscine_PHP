select UCASE(s.nom) as 'NOM', s.prenom, a.prix FROM fiche_personne s INNER JOIN membre t ON s.id_perso = t.id_fiche_perso INNER JOIN abonnement a ON t.id_abo = a.id_abo AND a.prix > 42 ORDER BY nom, prenom ASC;