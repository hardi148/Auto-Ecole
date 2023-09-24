
insert into magasins(users,mdp,nom,adresse) values ('hardi','hardi','Mikolo','Tongarivo');


insert into utilisateurs(nom,prenom,Mail,Mdp) values ('didi','tojoniaina','didi','didi');


insert into pointsdeventes(idmagasin,nom,adresse) values (1,'IT Solution','Analakely');



insert into fournisseurs(nomfournisseur) values ('SUPREME CENTER') , ('Masse In') , ('Ivandry');  


insert into clients(nomclient) values ('Rakoto') ;

INSERT INTO marques (marque) VALUES
  ('Hp'),
  ('ASUS'),
  ('MSI');

INSERT INTO referencs (reference, idmarque) VALUES
  ('Pavion', 1),
  ('ROG', 2),
  ('Carbon', 3);

INSERT INTO processeurs (processeur, frequence) VALUES
  ('Intel Core i7', 2.8),
  ('Intel Core i5', 2.4),
  ('AMD Ryzen 7', 3.2);

INSERT INTO rams (ram, type) VALUES
  (8, 'DDR4'),
  (16, 'DDR4'),
  (32, 'DDR4');

INSERT INTO ecrans (ecran, taille) VALUES
  ('IPS', 15.6),
  ('TN', 14),
  ('LED', 13.3);

INSERT INTO disques (disque, type) VALUES
  (256, 'SSD'),
  (512, 'SSD'),
  (1000, 'HDD');

INSERT INTO laptops (idreference, idram, iddisque, idecran, idprocesseur, images, reference, prixDeBase) VALUES
  (1, 2, 1, 1, 1, 'image1.jpg', 'MBP-001',1000000),
  (2, 3, 2, 2, 2, 'image2.jpg', 'XPS-002',2000000),
  (3, 1, 3, 3, 3, 'image3.jpg', 'Elite-003',3000000);


