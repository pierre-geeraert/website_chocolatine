CREATE TABLE pains (
        IDclient serial primary key,
        horodateur date default now(),
        argent integer default null,
        comment varchar(70) default 'pas de commentaire'
        );
