CREATE TABLE client (
	IDclient serial primary key,
	prenom varchar(25),
	nom varchar(30),
	téléphone integer,
	mail varchar(50),
	date date default now(),
	classe varchar(25),
	derangeable boolean default false,
	quantité_pains integer default null,
	quantité_croissant integer default null
	);
