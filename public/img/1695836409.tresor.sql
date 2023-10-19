-- Créer la bd
create database tresor;

-- Sélection de la bd
USE  tresor;

-- Table Categorie
CREATE table Categorie(
    idCategorie int auto_increment primary key,
    nomCategorie varchar(255) not null
);

-- Table Artiste
create table Artiste(
    idArtiste int auto_increment primary key ,
    nom varchar(255) not null ,
    prenom varchar(255) not null ,
    telephone varchar(50),
    unique key unique_artiste (nom, prenom)
);

-- Table Oeuvre
create table  Oeuvre(
    idOeuvre int auto_increment primary key ,
    nom varchar(255) not null,
    description text not null ,
    annee int,
    idArtiste int,
    idCategorie int,
    foreign key (idArtiste) references Artiste(idArtiste),
    foreign key (idCategorie) references Categorie(idCategorie)
);

-- Insérer les catégories de trésors

INSERT INTO Categorie(nomCategorie)
values
    ('Trésors royaux'),
    ('Arts contemporains');

-- Insérer les artistes
insert into Artiste(nom, prenom, telephone)
VALUES
    ('TOKOUDAGBA', 'Cyprien', '+22990320232'),
    ('PEDE', 'Apollinaire', '+22941606076');



