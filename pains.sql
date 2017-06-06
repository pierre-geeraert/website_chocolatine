CREATE TABLE pains (
        IDclient serial primary key,
        horodateur date default now(),
        argent integer default null,
        comment varchar(70) default 'pas de commentaire'
        );
        
        
insert into pains values(1,'2017-04-28',49,'pas de commentaire');
insert into pains values(2,'2017-05-05',45,'diminue car paiement boissons petit dej journée de selection');
insert into pains values(3,'2017-05-12',63,'perte de 30 euros pour selection avec ajout de 50 aprés');
insert into pains values(4,'2017-05-15',65.5,'pas de commentaire');
insert into pains values(5,'2017-05-23',64,'diminution car changement prix dù aux fournisseurs');
insert into pains values(6,'2017-06-01',60.15,'pas de commentaire');
insert into pains values(7,'2017-06-02',65.7,'pas de commentaire');
