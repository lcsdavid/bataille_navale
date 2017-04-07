#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Partie
#------------------------------------------------------------

CREATE TABLE Partie (
  id_partie        INT NOT NULL AUTO_INCREMENT,
  id_joueur1       INT NOT NULL,
  id_joueur2       INT NOT NULL,
  etat             VARCHAR(16),
  vainqueur        VARCHAR(16),
  timestamp        TIMESTAMP,
  id_joueur        INT,
  id_joueur_Joueur INT,
  PRIMARY KEY (id_partie)
);

#------------------------------------------------------------
# Table: Joueur
#------------------------------------------------------------

CREATE TABLE Joueur (
  id_joueur  INT         NOT NULL AUTO_INCREMENT,
  email      VARCHAR(32) NOT NULL,
  pseudonyme VARCHAR(16),
  nom        VARCHAR(16),
  prenom     VARCHAR(16),
  sexe       CHAR(1),
  naissance  DATE,
  ville      VARCHAR(16),
  mdp        VARCHAR(16),
  PRIMARY KEY (id_joueur, email)
);

#------------------------------------------------------------
# Table: Navire
#------------------------------------------------------------

CREATE TABLE Navire (
  id_navire INT NOT NULL AUTO_INCREMENT,
  id_joueur INT NOT NULL,
  type      VARCHAR(16),
  taille    INT,
  reference VARCHAR(64),
  position  VARCHAR(4),
  sens      CHAR(1),
  PRIMARY KEY (id_navire)
);

#------------------------------------------------------------
# Table: Tour
#------------------------------------------------------------

CREATE TABLE Tour (
  id_tour   TIMESTAMP NOT NULL,
  id_partie INT       NOT NULL,
  tir       VARCHAR(4),
  resultat  BOOLEAN,
  carte     VARCHAR(16),
  PRIMARY KEY (id_tour, id_partie)
);

ALTER TABLE Partie
  ADD FOREIGN KEY (id_joueur1) REFERENCES Joueur (id_joueur);
ALTER TABLE Partie
  ADD FOREIGN KEY (id_joueur2) REFERENCES Joueur (id_joueur);
ALTER TABLE Navire
  ADD FOREIGN KEY (id_joueur) REFERENCES Joueur (id_joueur);
ALTER TABLE Tour
  ADD FOREIGN KEY (id_partie) REFERENCES Partie (id_partie);