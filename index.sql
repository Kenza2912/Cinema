-- a. Informations d’un film (id_film) : titre, année, durée (au format HH:MM) et réalisateur 

SELECT f.titre, f.annee, SEC_TO_TIME(f.duree*60) AS duree, CONCAT(p.nom,' ', p.prenom) AS realisateur
FROM film f
LEFT JOIN realisateur r ON f.id_realisateur = r.id_realisateur
LEFT JOIN personne p ON r.id_personne = p.id_personne
WHERE f.id_film =1;



-- b. Liste des films dont la durée excède 2h15 classés par durée (du + long au + court)
SELECT f.titre, f.duree 
FROM  film f
WHERE f.duree > 135
ORDER BY f.duree DESC;


-- c. Liste des films d’un réalisateur (en précisant l’année de sortie) 
SELECT  f.titre, f.annee
FROM film f
LEFT JOIN realisateur r ON f.id_realisateur = r.id_realisateur
LEFT JOIN personne p ON r.id_personne = p.id_personne
WHERE CONCAT(p.prenom, ' ', p.nom) = 'James Cameron'
ORDER BY f.annee;



-- d. Nombre de films par genre (classés dans l’ordre décroissant)
SELECT g.libelle, COUNT(f.id_film) AS nbFilm
FROM appartient a
LEFT JOIN genre g ON a.id_genre = g.id_genre
LEFT JOIN film f ON a.id_film = f.id_film
GROUP BY g.libelle
ORDER BY nbFilm DESC;

-- e. Nombre de films par réalisateur (classés dans l’ordre décroissant)
SELECT CONCAT(p.prenom, ' ', p.nom) AS realisateur, COUNT(f.id_film) AS nbFilm
FROM film f
LEFT JOIN realisateur r ON f.id_realisateur = r.id_realisateur
LEFT JOIN personne p ON r.id_personne = p.id_personne
GROUP BY realisateur
ORDER BY nbFilm DESC;

-- f. Casting d’un film en particulier (id_film) : nom, prénom des acteurs + sexe
SELECT CONCAT(p.nom, ' ', p.prenom) AS acteur, p.sexe
FROM casting c
LEFT JOIN acteur a ON c.id_acteur = a.id_acteur
LEFT JOIN personne p ON a.id_personne = p.id_personne
WHERE c.id_film = 1
ORDER BY acteur;


-- g. Films tournés par un acteur en particulier (id_acteur) avec leur rôle et l’année de sortie (du film le plus récent au plus ancien)
SELECT f.titre, r.nomPersonnage, f.annee
FROM casting c
LEFT JOIN film f ON c.id_film = f.id_film
LEFT JOIN role r ON c.id_role = r.id_role
WHERE c.id_acteur = 3 
ORDER BY f.annee DESC;

-- h. Liste des personnes qui sont à la fois acteurs et réalisateurs
SELECT CONCAT(p.nom, ' ', p.prenom) AS personne
FROM acteur a
JOIN personne p ON a.id_personne = p.id_personne
WHERE EXISTS (
			SELECT a.id_acteur 
			FROM realisateur r 
			WHERE r.id_personne = a.id_personne
    );


-- i. Liste des films qui ont moins de 5 ans (classés du plus récent au plus ancien)

SELECT f.titre, f.annee
FROM film f
WHERE YEAR(NOW()) -  YEAR(f.annee)  < 5
ORDER BY f.annee DESC;

-- j. Nombre d’hommes et de femmes parmi les acteurs

SELECT p.sexe, COUNT(a.id_acteur) AS nbActeur
FROM acteur a
LEFT JOIN personne p ON a.id_personne = p.id_personne
GROUP BY p.sexe;

-- k. Liste des acteurs ayant plus de 50 ans (âge révolu et non révolu)
SELECT CONCAT(p.nom, ' ', p.prenom) AS acteur, p.dateNaissance
FROM acteur a 
LEFT JOIN personne p ON a.id_personne = p.id_personne
WHERE YEAR(NOW()) - YEAR(p.dateNaissance) > 50



-- l. Acteurs ayant joué dans 3 films ou plus
SELECT CONCAT(p.nom, ' ', p.prenom) AS acteur,COUNT(f.id_film) AS nbFilm
FROM casting c
LEFT JOIN acteur a ON c.id_acteur = a.id_acteur
LEFT JOIN personne p ON a.id_personne = p.id_personne
LEFT JOIN film f ON c.id_film = f.id_film
GROUP BY a.id_acteur
HAVING COUNT(f.id_film) >= 3
ORDER BY nbFilm DESC;




