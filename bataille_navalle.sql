#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Partie
#------------------------------------------------------------

CREATE TABLE Partie(
        id_partie        Integer NOT NULL ,
        etat             Varchar (25) ,
        temps            TimeStamp ,
        vainqueur        Varchar (25) ,
        id_joueur        Int ,
        id_joueur_Joueur Int ,
        PRIMARY KEY (id_partie )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Joueur
#------------------------------------------------------------

CREATE TABLE Joueur(
        id_joueur  Int NOT NULL ,
        pseudonyme Varchar (25) ,
        nom        Varchar (25) ,
        prenom     Varchar (25) ,
        sexe       Bool ,
        naissance  Date ,
        ville      Char (25) ,
        mdp        Varchar (25) ,
        PRIMARY KEY (id_joueur )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Navire
#------------------------------------------------------------

CREATE TABLE Navire(
        id_navire    Int NOT NULL ,
        type         Varchar (25) ,
        taille       Int ,
        reference    Varchar (25) ,
        id_joueur    Int ,
        id_coordonee Int ,
        PRIMARY KEY (id_navire )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Position bateau
#------------------------------------------------------------

CREATE TABLE Position_bateau(
        id_coordonee Int NOT NULL ,
        cellule      Varchar (25) ,
        sens         Bool ,
        id_navire    Int ,
        PRIMARY KEY (id_coordonee )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Tour
#------------------------------------------------------------

CREATE TABLE Tour(
        id_tour   TimeStamp NOT NULL ,
        tir       Varchar (25) ,
        resultat  Bool ,
        carte     Varchar (25) ,
        id_partie Integer ,
        PRIMARY KEY (id_tour )
)ENGINE=InnoDB;

ALTER TABLE Partie ADD CONSTRAINT FK_Partie_id_joueur FOREIGN KEY (id_joueur) REFERENCES Joueur(id_joueur);
ALTER TABLE Partie ADD CONSTRAINT FK_Partie_id_joueur_Joueur FOREIGN KEY (id_joueur_Joueur) REFERENCES Joueur(id_joueur);
ALTER TABLE Navire ADD CONSTRAINT FK_Navire_id_joueur FOREIGN KEY (id_joueur) REFERENCES Joueur(id_joueur);
ALTER TABLE Navire ADD CONSTRAINT FK_Navire_id_coordonee FOREIGN KEY (id_coordonee) REFERENCES Position_bateau(id_coordonee);
ALTER TABLE Position_bateau ADD CONSTRAINT FK_Position_bateau_id_navire FOREIGN KEY (id_navire) REFERENCES Navire(id_navire);
ALTER TABLE Tour ADD CONSTRAINT FK_Tour_id_partie FOREIGN KEY (id_partie) REFERENCES Partie(id_partie);
