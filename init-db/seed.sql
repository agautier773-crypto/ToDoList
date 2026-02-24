
-- DELETE TABLE tache_user;
-- DELETE TABLE user;
-- DELETE TABLE tache;
-- DELETE TABLE categorie;


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