#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: parametre
#------------------------------------------------------------

CREATE TABLE parametre(
        id         int (11) Auto_increment  NOT NULL ,
        date_ajout Date ,
        corde      Int ,
        tmax_p     Float ,
        tmax_mm    Int ,
        fmax_p     Float ,
        fmax_mm    Int ,
        nb_point   Int ,
        fic_img    Char (25) ,
        fic_csv    Char (25) ,
        libelle    Char (25) ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: cambrure
#------------------------------------------------------------

CREATE TABLE cambrure(
        id           int (11) Auto_increment  NOT NULL ,
        x            Int ,
        t            Float ,
        f            Float ,
        yintra       Float ,
        yextra       Float ,
        igx          Float ,
        id_parametre Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;

ALTER TABLE cambrure ADD CONSTRAINT FK_cambrure_id_parametre FOREIGN KEY (id_parametre) REFERENCES parametre(id);
