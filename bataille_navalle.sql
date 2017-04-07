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
        FOREIGN KEY (id_joueur1) REFERENCES Joueur(id_joueur)
	FOREIGN KEY (id_joueur2) REFERENCES Joueur(id_joueur)
)


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
)


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
        PRIMARY KEY (id_navire ) ,
        FOREIGN KEY (id_joueur) REFERENCES Joueur(id_joueur)
)


#------------------------------------------------------------
# Table: Tour
#------------------------------------------------------------

CREATE TABLE Tour(
        id_tour          TimeStamp NOT NULL ,
        id_partie        Int NOT NULL ,
        tir              Varchar (4) ,
        resultat         Bool ,
        carte            Varchar (16) ,
        PRIMARY KEY (id_tour ,id_partie )
	FOREIGN KEY (id_partie) REFERENCES Partie(id_partie);
)
