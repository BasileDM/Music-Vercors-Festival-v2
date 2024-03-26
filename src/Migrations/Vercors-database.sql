#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Utilisateur
#------------------------------------------------------------

CREATE TABLE vercors_utilisateurs(
        ID        Int  Auto_increment  NOT NULL ,
        NOM       Varchar (50) NOT NULL ,
        PRENOM    Varchar (50) NOT NULL ,
        TELEPHONE Varchar (12) NOT NULL ,
        ADRESSE   Varchar (100) NOT NULL ,
        PASSWORD  Varchar (255) NOT NULL ,
        ROLE      Varchar (50) ,
        RGPD      Date NOT NULL ,
        MAIL      Varchar (80) NOT NULL
	,CONSTRAINT AK_vercors_utilisateurs UNIQUE (MAIL)
	,CONSTRAINT PK_vercors_utilisateurs PRIMARY KEY (ID)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Reservation
#------------------------------------------------------------

CREATE TABLE vercors_reservations(
        ID                  Int  Auto_increment  NOT NULL ,
        NOMBRE_RESERVATIONS Int NOT NULL ,
        PRIX_TOTAL          Integer NOT NULL ,
        ID_UTILISATEUR      Int NOT NULL
	,CONSTRAINT PK_vercors_reservations PRIMARY KEY (ID)

	,CONSTRAINT FK_vercors_reservations_vercors_utilisateurs FOREIGN KEY (ID_UTILISATEUR) REFERENCES vercors_utilisateurs(ID)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Pass
#------------------------------------------------------------

CREATE TABLE vercors_pass(
        ID   Int  Auto_increment  NOT NULL ,
        PRIX Integer NOT NULL ,
        NOM  Varchar (50) NOT NULL
	,CONSTRAINT AK_vercors_pass UNIQUE (NOM)
	,CONSTRAINT PK_vercors_pass PRIMARY KEY (ID)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Nuitee
#------------------------------------------------------------

CREATE TABLE vercors_nuitees(
        ID   Int  Auto_increment  NOT NULL ,
        PRIX Integer NOT NULL ,
        NOM  Varchar (50) NOT NULL
	,CONSTRAINT AK_vercors_nuitees UNIQUE (NOM)
	,CONSTRAINT PK_vercors_nuitees PRIMARY KEY (ID)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Extras
#------------------------------------------------------------

CREATE TABLE vercors_extras(
        ID    Int  Auto_increment  NOT NULL ,
        STOCK Int ,
        PRIX  Integer ,
        NOM   Varchar (50) NOT NULL
	,CONSTRAINT AK_vercors_extras UNIQUE (NOM)
	,CONSTRAINT PK_vercors_extras PRIMARY KEY (ID)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: vercors_relation_reservation_pass
#------------------------------------------------------------

CREATE TABLE VERCORS_RELATION_RESERVATION_PASS(
        ID             Int NOT NULL ,
        ID_RESERVATION Int NOT NULL ,
        JOUR           Date NOT NULL
	,CONSTRAINT PK_VERCORS_RELATION_RESERVATION_PASS PRIMARY KEY (ID,ID_RESERVATION)

	,CONSTRAINT FK_VERCORS_RELATION_RESERVATION_PASS_vercors_pass FOREIGN KEY (ID) REFERENCES vercors_pass(ID)
	,CONSTRAINT FK_VERCORS_RELATION_RESERVATION_PASS_vercors_reservations0 FOREIGN KEY (ID_RESERVATION) REFERENCES vercors_reservations(ID)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: vercors_relation_reservation_nuitee
#------------------------------------------------------------

CREATE TABLE VERCORS_RELATION_RESERVATION_NUITEE(
        ID             Int NOT NULL ,
        ID_RESERVATION Int NOT NULL ,
        JOUR           Date NOT NULL
	,CONSTRAINT PK_VERCORS_RELATION_RESERVATION_NUITEE PRIMARY KEY (ID,ID_RESERVATION)

	,CONSTRAINT FK_VERCORS_RELATION_RESERVATION_NUITEE_vercors_nuitees FOREIGN KEY (ID) REFERENCES vercors_nuitees(ID)
	,CONSTRAINT FK_VERCORS_RELATION_RESERVATION_NUITEE_vercors_reservations0 FOREIGN KEY (ID_RESERVATION) REFERENCES vercors_reservations(ID)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: vercors_relation_reservation_extras
#------------------------------------------------------------

CREATE TABLE VERCORS_RELATION_RESERVATION_EXTRAS(
        ID             Int NOT NULL ,
        ID_RESERVATION Int NOT NULL
	,CONSTRAINT PK_VERCORS_RELATION_RESERVATION_EXTRAS PRIMARY KEY (ID,ID_RESERVATION)

	,CONSTRAINT FK_VERCORS_RELATION_RESERVATION_EXTRAS_vercors_extras FOREIGN KEY (ID) REFERENCES vercors_extras(ID)
	,CONSTRAINT FK_VERCORS_RELATION_RESERVATION_EXTRAS_vercors_reservations0 FOREIGN KEY (ID_RESERVATION) REFERENCES vercors_reservations(ID)
)ENGINE=InnoDB;

