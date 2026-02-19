-- Copie Colle le DCL et DDL
-- DCL

-- Creation BDD
Create Database IF NOT EXISTS ToDoList;

-- Creation user
CREATE USER IF NOT EXISTS 'lambdas'@'localhost' IDENTIFIED BY 'lambdas';

-- Accorde les droit sur la base
GRANT ALL PRIVILEGES ON ToDoList.* TO 'lambdas'@'localhost';

USE ToDoList;


-- DDL
------------------------------- DROP --------------------------------
DROP TABLE IF EXISTS tache_user;
DROP TABLE IF EXISTS tache;
DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS categorie;

------------------------------ CREATE -------------------------------
CREATE TABLE IF NOT EXISTS categorie(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS tache(
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(200) NOT NULL,
    description TEXT,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_fin DATE, -- à préciser
    categorie_id INT NOT NULL,
    statut ENUM('à faire', 'en cours', 'terminé') DEFAULT 'à faire',
    FOREIGN KEY (categorie_id) REFERENCES categorie(id) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS user(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS tache_user(
    tache_id INT,
    user_id INT,

    FOREIGN KEY (tache_id) REFERENCES tache(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (user_id) REFERENCES user(id) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;



-- DML
------------------------------- DELETE --------------------------------
TRUNCATE TABLE tache_user;
TRUNCATE TABLE user;
TRUNCATE TABLE tache;
TRUNCATE TABLE categorie;


------------------------------- INSERT --------------------------------
INSERT INTO categorie (nom) VALUES
('Ménagère'),
('Professionnelle'),
('Personnelle'),
('Économique');

INSERT INTO tache (titre, description, date_fin, statut, categorie_id) VALUES
('Nettoyer l`appart','','2026-02-19','à faire', 1),
('Finir CategorieController', 'Réécrire le code de l`article pour en faire une catégorie', '2026-02-21','en cours', 2),
('Nettoyer la voiture','', '2026-02-28','à faire',1),
('Payer loyer','','2026-02-28','à faire',4);

INSERT INTO user (nom, prenom, email, password) VALUES
('Dumas', 'Porthos', 'porthos@mousq92.fr', '$2y$10$MkBe3YUuiaaKNSZ7IFvH3eOPYDHfeJR3BPpOBn2F7GK1sovP.4vXq'),
('Fairy', 'Morgane', 'trahisondisgrace@penta.en','$2y$10$ar.g1nX3uFWJWMsHE7gQW.sXFTVHgyM3p0VPuCr4SZL0TPeEpGTzO'),
('Wood', 'Robin', 'hero@woodie.en','$2y$10$aNuPGiWtsoGJIZJcbELgQ.Qg5w/egBcTxVbT4AhbLdWCuehPcOiN2');

INSERT INTO tache_user (user_id, tache_id) VALUES
(2,1),
(3,4),
(1,2),
(1,3);


commit;
---------------------------------------------------------------------
