
drop view v_examen;
drop view v_etudiant_final;
drop view v_etudiant;
drop view v_paiement;

drop table paiementecolages;
drop table examens;
drop table parcours;
drop table permis;
drop table etudiants;
drop table admins;
drop table autos;


create table autos(
idauto serial PRIMARY key,
nom varchar(30),
adresse varchar(30)
);

create table admins (
idadmin SERIAL PRIMARY KEY,
users varchar(20),
mdp varchar(20)
);


insert into admins(users,mdp) values('hardi','hardi');


create table etudiants(
idetudiant serial primary key,
nom varchar(30),
prenom varchar(30),
numtel text,
adresse text,
dateinscription date default current_date,
frais int default 0,
date timestamp default current_timestamp
);

create table permis(
idpermi serial primary key,
typepermi varchar(10),
montant float
);


insert into permis(typepermi,montant) values ('permis A1',100000) , ('permis A2',200000) , ('permis B',300000)  , ('permis C',400000)  , ('permis D',500000) , ('permis E',600000) ;


create table parcours(
idparcour serial primary key,
idetudiant int references etudiants(idetudiant),
idpermi int references permis(idpermi),
nbtranche int,
estpaye int default 0,
codetermine int default 0,
conduitetermine int default 0,
nbcode int default 0,
nbconduite int default 0,
dateinscription date default current_date,
date timestamp default current_timestamp
);




create table examens(
idexamen serial primary key,
idetudiant int references etudiants(idetudiant),
idpermi int references permis(idpermi),
typeexamen varchar(10),
resultat int default 0,
droitexamen int default 0,
dateexamen date default current_date,
date timestamp default current_timestamp
);




create table paiementecolages(
idpaiement serial primary key,
idetudiant int references etudiants(idetudiant),
idpermi int references permis(idpermi),
montant float,
datepaiement date default current_date,
date timestamp default current_timestamp
);



create view v_paiement as 
select e.* , pe.idpaiement , pe.idpermi , p.estpaye , ps.typepermi , pe.montant , pe.datepaiement , pe.date as date_paiement from etudiants e  join parcours p using(idetudiant)  join paiementecolages pe using(idetudiant,idpermi) join permis ps using(idpermi);


create view v_etudiant as 
select p.idetudiant , p.idpermi , coalesce(sum(pe.montant),0) as total_montant , coalesce(count(pe.idpaiement),0) as nbre from etudiants e  join parcours p using(idetudiant) left join paiementecolages pe using(idetudiant,idpermi) left join permis ps using(idpermi) group by p.idetudiant,p.idpermi;



create view v_etudiant_final as 
select pc.nbtranche - v1.nbre as tranche_restante , e.nom , e.prenom , e.numtel , e.adresse , e.dateinscription , e.frais , e.date , v1.total_montant , coalesce(p.montant-v1.total_montant,0) as reste , v1.idetudiant , v1.idpermi , p.typepermi , p.montant , pc.nbtranche , pc.estpaye , pc.codetermine , pc.conduitetermine , pc.idparcour , pc.nbcode , pc.nbconduite from etudiants e left join v_etudiant v1 using(idetudiant) left join parcours pc using(idetudiant,idpermi) left join permis p using(idpermi);


create view v_examen as 
select e.* , ex.idexamen , ex.dateexamen , ex.date as date_examen , ex.typeexamen , ex.droitexamen , ex.resultat , p.typepermi  from etudiants e join examens ex using(idetudiant) join permis p using(idpermi); 
