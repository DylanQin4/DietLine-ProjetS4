CREATE TABLE genre (
    id int PRIMARY KEY AUTO_INCREMENT,
    genre varchar(25) NOT NULL
);

CREATE TABLE users (
    id int PRIMARY KEY AUTO_INCREMENT,
    username varchar(50) NOT NULL DEFAULT '',
    email varchar(100) NOT NULL DEFAULT '',
    id_genre int REFERENCES genre(id_genre),
    password varchar(255) NOT NULL DEFAULT '',
    avatar varchar(255) DEFAULT 'default.jpg',
    created_at datetime NOT NULL,
    is_admin tinyint NOT NULL DEFAULT '0',
    taille numeric(3,2),
    poids numeric(6,3),
    wallet numeric(10,2) default 0
);

CREATE TABLE histo_morphology (
    id int PRIMARY KEY AUTO_INCREMENT,
    id_user int REFERENCES users(id),
    poids numeric(6,3) NOT NULL,
    updated_at datetime NOT NULL
);

CREATE TABLE valeur (
    id int PRIMARY KEY AUTO_INCREMENT,
    valeur numeric(8,2) NOT NULL
);

CREATE TABLE codes (
    id int PRIMARY KEY AUTO_INCREMENT,
    codes varchar(255) NOT NULL,
    id_valeur int references valeur(id),
    is_valide int NOT NULL DEFAULT 1
);

CREATE TABLE validation_codes(
    id int PRIMARY KEY AUTO_INCREMENT,
    id_code int references codes(id),
    id_user int REFERENCES users(id),
    is_valide int NOT NULL DEFAULT 0
);

create table imc(
    id int primary key auto_increment,
    libelle varchar(50) NOT NULL,
    indice_debut numeric(6,2),
    indice_fin numeric(6,2)
);

create table regime_type(
    id int primary key auto_increment,
    type varchar(255) 
);

create table plat (
    id int primary key auto_increment,
    id_type_regime int references regime_type(id),
    nom varchar(255),
    ingredients text not null, 
    prix numeric(8,2) not null
);

select count(id) from plat;

create table sport (
    id int primary key auto_increment,
    id_type_regime int references regime_type(id),
    nom varchar(255) not null
);

create table periode_regime (
    id int primary key auto_increment,
    id_user int references users(id),
    id_type int references regime_type(id),
    poids_objectif numeric(8,2),
    date_debut date not null,
    date_fin date not null,
    etat int default 0;
);

create table regime(
    id int primary key auto_increment,
    id_periode_regime int references periode_regime(id)
);

create table details_aliments(
    id int primary key auto_increment,
    id_regime int references regime(id),
    id_plat int references plat(id),
    poids numeric(6,2) not null
);

create table details_sportif(
    id int primary key auto_increment,
    id_regime int references regime(id),
    id_sport int references sport(id),
    duree numeric(5,2)
);

create table type_viande(
    id int primary key auto_increment,
    nom varchar(50)
);

create table pourcentage_viande(
    id int primary key auto_increment,
    id_viande int references type_viande(id),
    id_plat int references plat(id),
    poucentage numeric(5,2) default 0
);

INSERT INTO genre(id, genre) VALUES 
    (null, 'Homme'),
    (null, 'Femme');

INSERT INTO users(id, username, email, id_genre, password, avatar, created_at, is_admin, taille, poids, wallet) VALUES 
    (null, 'Rakoto', 'rakoto@gmail.com', 1, '12345', 'default.jpg', '2023-07-02 12:05:01', 1, null, null, 5000),
    (null, 'Rabe', 'rabe@gmail.com', 1, '56789', 'default.jpg', '2023-07-04 09:00:01', 0, 1.63, '80.400', 10000),
    (null, 'Rasoa', 'rasoa@gmail.com', 2, '54321', 'default.jpg', '2023-07-05 14:25:30', 0, 1.60, '65.100', 9000),
    (null, 'Rose', 'rose@gmail.com', 2, '98765', 'default.jpg', '2023-07-10 22:00:45', 0, 1.58, '70', 15000),
    (null, 'Randria', 'randria@gmail.com', 1, '02580', 'default.jpg', '2023-07-10 12:20:45', 0, 1.70, '75.900', 25000);

INSERT INTO valeur VALUES
    (null, '100'),
    (null, '200'),
    (null, '500'),
    (null, '1000'),
    (null, '2000'),
    (null, '5000'),
    (null, '10000'),
    (null, '20000');

INSERT INTO codes VALUES 
    (null, '8365491723', 1, 1),
    (null, '9056213487', 2, 1),
    (null, '7214569832', 3, 1),
    (null, '3698471025', 4, 1),
    (null, '5487120369', 5, 1),
    (null, '1029384756', 6, 1),
    (null, '6543210987', 7, 1),
    (null, '9876543210', 8, 1),
    (null, '1234567890', 5, 1),
    (null, '7890123456', 6, 1),
    (null, '2468135790', 7, 1),
    (null, '1357924680', 8, 1),
    (null, '8024671359', 6, 1),
    (null, '6940281357', 7, 1),
    (null, '5719203846', 8, 1);

INSERT INTO regime_type VALUES
    (null, 'Reduire son poids'),
    (null, 'Augmenter son poids');

INSERT INTO plat VALUES
    (null, 1,'Delice matinale', 'Thé vert, Fromage blanc au muesli et compote de fruits maison', '8000'),
    (null, 1, 'Fraîcheur croquante', 'Rouleaux de printemps crevettes et pomme verte, Salade de pousses de soja, Fruit de saison', '15000'),
    (null, 1, 'Parmentier gourmand et salade fraîcheur', 'Hachis parmentier à la courge et au poulet, Salade, Fromage blanc', '5000'),
    (null, 1, 'Délice protéiné', 'Café sans sucre, Oeufs brouillés au fromage frais et toast de pain complet', '7000'),
    (null, 1, 'Crunchy saveurs', 'Salade de carottes, Poulet aux olives et citron confit, Semoule, Fruit de saison', '10000'),
    (null, 1, 'Exotisme végétarien aux notes croquantes', 'Sauté de tofu aux noix de cajou et haricots plats, Riz brun, Fromage frais, Fruit frais', '7000'),
    (null, 2, 'Sandwich confiture et beurre de cacahuète', '2 tranches de pain de mie, 2 cuillères à café de beurre de cacahuète, 2 cuillères à café de confiture de fruits rouges', '7000'),
    (null, 2, 'Risotto au pesto et petits pois', 'Petits pois, riz à grains ronds, pesto, beurre, oignon, bouillon de volaille, quelques feuilles de basilic', '25000'),
    (null, 2, 'Pain équilibré aux olives', 'Farine, olives noires dénoyautées, levure fraîche, huile olive, eau tiède, romarin, sel', '7000'),
    (null, 2, 'Biscuits « gainer » au beurre de cacahuète', 'Farine, sucre roux, beurre de cacahuètes, beurre mou, œuf, levure chimique', '9000'),
    (null, 2, 'Roulés de crêpes gain de poids en gratin poulet et béchamel', 'Poulet, gruyère râpé, farine, œufs, lait entier, beurre, noix de muscade, sel et poivre', '25000'),
    (null, 2, 'Quatre-quarts', 'Oeufs, sucre, farine, beurre, levure chimique', '10000');
    
INSERT INTO imc values
    (null, 'Maigreur', 0, 18.5),
    (null, 'Normal', 18.5, 25),
    (null, 'Surpoids', 25, 30),
    (null, 'Obesite moderee', 30, 40),
    (null, 'obesite severe', 40, 1000);

INSERT INTO type_viande VALUES 
    (null, 'Viande'),
    (null, 'Poisson'),
    (null, 'Volaille');

INSERT INTO pourcentage_viande VALUES
    (null, 1, 1, 0),
    (null, 2, 2, 10),
    (null, 3, 3, 25),
    (null, 1, 4, 0),
    (null, 3, 5, 35),
    (null, 1, 6, 0),
    (null, 1, 7, 0),
    (null, 3, 8, 50),
    (null, 1, 9, 0),
    (null, 1, 10, 0),
    (null, 3, 11, 60),
    (null, 1, 12, 0);

INSERT INTO sport VALUES
    (null, 1, 'Course à pied'),
    (null, 1, 'Zumba'),
    (null, 1, 'Planche'),
    (null, 1, 'Corde a sauter'),
    (null, 1, 'Cyclisme'),
    (null, 2, 'Pompes'),
    (null, 2, 'Squat'),
    (null, 2, 'Soulevé de terre'),
    (null, 2, 'Developpé couché'),
    (null, 2, 'Natation');
    
