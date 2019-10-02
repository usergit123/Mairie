drop database Mairie;
create database Mairie;
use Mairie;

create table cantine
(idC int(3) not null auto_increment,
ville varchar(50),
codePostal char(5),
prix float,
primary key(idC)
);
create table loisir
(idL int(3) not null auto_increment,
libelle varchar(50),
lieu varchar(50),
primary key(idL)
);
create table personne
(idP int(3) not null auto_increment,
pseudo varchar(20) unique,
mdp varchar(50),
nom varchar(20),
prenom varchar(20),
adresse varchar(50),
tel varchar(20),
cp char(5),
email varchar(20),
datenaiss date,
sexe enum("homme","femme"),
fonction varchar(50),
primary key(idP)
);
create table Bon
(idB int(3) not null auto_increment,
primary key(idB)
);
create table evenement
(idEV int(3) not null auto_increment,
lieu varchar(50),
libelle varchar(50),
dateEV date,
primary key(idEV)
);
create table association
(idA int(3) not null auto_increment,
libelleA varchar(50),
adresse varchar(50),
tel char(10),
codeP int,
dateA date,
primary key(idA)
);
create table enfants
(idE int(3) not null auto_increment,
idP int(3) not null,
idC int(3) not null,
nomE varchar(20),
prenomE varchar(20),
sexe enum("fille","garçon"),
primary key(idE),
foreign key(idP) references personne(idP),
foreign key(idC) references cantine(idC)
);
create table actes
(idF int(3) not null auto_increment,
idP int(3) not null,
mariage varchar(20),
naissance varchar(20),
deces varchar(20),
primary key(idF),
foreign key(idP) references personne(idP)
);
create table participer
(idL int(3) not null,
idP int(3) not null,
datePL date,
primary key(idL,idP),
foreign key(idL) references loisir(idL),
foreign key(idP) references personne(idP)
);
create table inscription
(idA int(3) not null,
idP int(3) not null,
dateIns date,
montant float,
primary key(idA,idP, dateIns),
foreign key(idA) references association(idA),
foreign key(idP) references personne(idP) 
);
create table assister
(idP int(3) not null,
idEV int(3) not null,
dateEV date,
primary key(idP,idEV, dateEV),
foreign key(idEV) references evenement(idEV),
foreign key(idP) references personne(idP)
);
create table mariage
(idP1 int(3) not null,
idP2 int(3) not null,
dateMariage date not null,
datedivorce date,
primary key(idP1,idP2,dateMariage),
foreign key(idP1) references personne(idP),
foreign key(idP2) references personne(idP)
);

create table admin
(numA int not null,
pseudo varchar(20),
mdp varchar(20) not null,
primary key(numA)
);

insert into loisir values(null, "concert", "Quincy");

INSERT INTO personne (idP,pseudo,mdp,nom,prenom,adresse,Tel,cp,email,datenaiss,sexe,fonction) 
VALUES (null,"kev", 123,"Henry","Kevin", "28 rue delacarte","0102030405",75000,"kevin@henry.fr","1996/01/04","homme","PDG"),
	   (null,"aud", 42,"Puechmaille","Audran","perpete les oies","0504030201",7500,"audran@puecmaille.fr","1996/02/02","femme","esclave");

insert into cantine 
values (null,"ville",75000,5);

insert into loisir 
values(null,"libelle","lieu"),
	  (null,"cinema","brunoy");

insert into mariage(idP1,idP2,dateMariage,datedivorce) values (1,2,'2018/09/01','2019/01/01');

insert into evenement(idEV, lieu, libelle, dateEV) values (null, 'defense', 'fete', '2007/02/04');

insert into association (idA,libelleA,adresse,tel,codeP, dateA) values (null, 'association1', 'adresse association', 0102030405, 75000, '2008/05/06');

insert into actes (idF, idP, mariage, naissance, deces) values (null, 1, '2018/09/01','1997/01/04',null);

insert into enfants (idE, idP, idC, nomE, prenomE, sexe) values (null, 1, 1, 'ben', 'ocka', 'garçon');

insert into admin values (1,'kevin',123);

insert into evenement(idEV, lieu, libelle, DateEV) 
values (null, 'defense', 'fete', "2019-02-10"),
	   (null, 'E-sport', 'competition', "2019-02-10"),
	   (null, 'Paris 17', 'Concours de programmation', "2019-01-10"),
	   (null, 'Evry', 'Sprint 200m', "2019-01-10"),
	   (null, 'Antibes', 'Beach party', "2019-01-10"),
	   (null, 'Monaco', 'Piscine geante', "2019-03-10"),
	   (null, 'Normandie', 'Peche au gros', "2019-03-10"),
	   (null, 'Saint-Germain-en-Laye', 'Foot en salle', "2019-03-10"),
	   (null, 'Bercy', 'Concert', "2019-02-10");
