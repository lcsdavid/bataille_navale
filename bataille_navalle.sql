#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Partie
#------------------------------------------------------------

CREATE TABLE Partie (
  id_partie  INT         NOT NULL AUTO_INCREMENT,
  id_joueur1 VARCHAR(21) NOT NULL,
  id_joueur2 VARCHAR(21),
  vainqueur  VARCHAR(21),
  t_creation TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id_partie)
);

#------------------------------------------------------------
# Table: Joueur
#------------------------------------------------------------

CREATE TABLE Joueur (
  id_joueur  VARCHAR(21) NOT NULL,
  email      VARCHAR(32) NOT NULL,
  nom        VARCHAR(16) NOT NULL,
  prenom     VARCHAR(16) NOT NULL,
  sexe       CHAR(1)     NOT NULL,
  naissance  DATE        NOT NULL,
  ville      VARCHAR(16) NOT NULL,
  mdp        VARCHAR(16) NOT NULL,
  t_creation TIMESTAMP   NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id_joueur),
  UNIQUE (email)
);

#------------------------------------------------------------
# Table: Navire
#------------------------------------------------------------

CREATE TABLE Navire (
  id_navire  INT         NOT NULL AUTO_INCREMENT,
  id_joueur  VARCHAR(21) NOT NULL,
  id_partie  INT         NOT NULL,
  type_nav   VARCHAR(16) NOT NULL,
  taille     TINYINT     NOT NULL,
  reference  VARCHAR(64) NOT NULL DEFAULT "https://fr.wikipedia.org",
  position   VARCHAR(4)  NOT NULL,
  sens       CHAR(1)     NOT NULL,
  t_creation TIMESTAMP   NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id_navire)
);

#------------------------------------------------------------
# Table: Tour
#------------------------------------------------------------

CREATE TABLE Tour (
  id_tour   INT         NOT NULL AUTO_INCREMENT,
  id_partie INT         NOT NULL,
  id_joueur VARCHAR(21) NOT NULL,
  resultat  CHAR(1)     NOT NULL,
  carte     VARCHAR(16) NOT NULL,
  t_joue    TIMESTAMP   NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id_tour)
);

#------------------------------------------------------------
# Table: Etat joueur
#------------------------------------------------------------

CREATE TABLE Etat joueur (
  id_joueur   VARCHAR(21) NOT NULL,
  etat_joueur VARCHAR(16) NOT NULL,
  t_chgmt     TIMESTAMP   NOT NULL DEFAULT CURRENT_TIMESTAMP,
);

#------------------------------------------------------------
# Table: Etat partie
#------------------------------------------------------------

CREATE TABLE Etat partie (
  id_partie   VARCHAR(21) NOT NULL,
  etat_partie VARCHAR(16) NOT NULL,
  t_chgmt     TIMESTAMP   NOT NULL DEFAULT CURRENT_TIMESTAMP,
);

ALTER TABLE Partie
  ADD FOREIGN KEY (id_joueur1) REFERENCES Joueur (id_joueur);
ALTER TABLE Partie
  ADD FOREIGN KEY (id_joueur2) REFERENCES Joueur (id_joueur);
ALTER TABLE Navire
  ADD FOREIGN KEY (id_joueur) REFERENCES Joueur (id_joueur);
ALTER TABLE Tour
  ADD FOREIGN KEY (id_partie) REFERENCES Partie (id_partie);
ALTER TABLE Tour
  ADD FOREIGN KEY (id_joueur) REFERENCES Joueur (id_joueur);
ALTER TABLE Etat joueur
  ADD FOREIGN KEY (id_joueur) REFERENCES Joueur (id_joueur);
ALTER TABLE Etat partie
  ADD FOREIGN KEY (id_partie) REFERENCES Partie (id_partie);