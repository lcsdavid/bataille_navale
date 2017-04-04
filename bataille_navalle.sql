#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Partie
#------------------------------------------------------------

CREATE TABLE Partie(
        id_partie        int (11) Auto_increment  NOT NULL ,
        id_joueur1       Int ,
        id_joueur2       Int ,
        etat             Varchar (16) ,
        vainqueur        Varchar (16) ,
        timestamp        TimeStamp ,
        id_joueur        Int ,
        id_joueur_Joueur Int ,
        PRIMARY KEY (id_partie ) ,
        INDEX (id_joueur1 ,id_joueur2 )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Joueur
#------------------------------------------------------------

CREATE TABLE Joueur(
        id_joueur  int (11) Auto_increment  NOT NULL ,
        pseudonyme Varchar (16) ,
        nom        Varchar (16) ,
        prenom     Varchar (16) ,
        sexe       Bool ,
        naissance  Date ,
        ville      Varchar (16) ,
        mdp        Varchar (16) ,
        PRIMARY KEY (id_joueur )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Navire
#------------------------------------------------------------

CREATE TABLE Navire(
        id_navire        int (11) Auto_increment  NOT NULL ,
        id_joueur        Int ,
        type             Varchar (16) ,
        taille           Int ,
        reference        Varchar (64) ,
        position         Varchar (4) ,
        sens             Bool ,
        id_joueur_Joueur Int ,
        PRIMARY KEY (id_navire ) ,
        INDEX (id_joueur )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Tour
#------------------------------------------------------------

CREATE TABLE Tour(
        id_tour          TimeStamp NOT NULL ,
        id_partie        Int NOT NULL ,
        tir              Varchar (4) ,
        resultat         Bool ,
        carte            Varchar (16) ,
        id_partie_Partie Int ,
        PRIMARY KEY (id_tour ,id_partie )
)ENGINE=InnoDB;

ALTER TABLE Partie ADD CONSTRAINT FK_Partie_id_joueur FOREIGN KEY (id_joueur) REFERENCES Joueur(id_joueur);
ALTER TABLE Partie ADD CONSTRAINT FK_Partie_id_joueur_Joueur FOREIGN KEY (id_joueur_Joueur) REFERENCES Joueur(id_joueur);
ALTER TABLE Navire ADD CONSTRAINT FK_Navire_id_joueur_Joueur FOREIGN KEY (id_joueur_Joueur) REFERENCES Joueur(id_joueur);
ALTER TABLE Tour ADD CONSTRAINT FK_Tour_id_partie_Partie FOREIGN KEY (id_partie_Partie) REFERENCES Partie(id_partie);
