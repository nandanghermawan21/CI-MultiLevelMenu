CREATE TABLE menu(
    id INT NOT NULL AUTO_INCREMENT,
    nama VARCHAR(100),
    url VARCHAR(1000),
    class_icon VARCHAR(50),
    active INT,
    PRIMARY KEY (id)
)


CREATE TABLE menu_tree(
  id INT,
  parent_id INT,
  group_id INT,
  PRIMARY KEY (id,parent_id,group_id) ,
  CONSTRAINT fk_menu FOREIGN KEY (id) REFERENCES menu(id)
)


/*sample data*/

INSERT INTO  menu
(nama, url, class_icon, active)
VALUES
('Menu 1','#','fa fa-home',1),
('Menu 1.1','#','fa fa-database',1),
('Menu 1.2','#','fa  fa-users ',1),
('Menu 1.1.1','#','fa fa-bars',1),
('Menu 1.1.2','#','fa fa-home',1),
('Menu 1.1.1.1','#','fa fa-database',1),
('Menu 1.1.1.2','#','fa  fa-users ',1),
('Menu 1.1.2.1','#','fa fa-bars',1),
('Menu 2','#','fa fa-home',1),
('Menu 2.1','#','fa fa-database',1),
('Menu 2.2','#','fa  fa-users ',1),
('Menu 2.1.1','#','fa fa-bars',1),
('Menu 2.1.2','#','fa fa-home',1),
('Menu 2.1.1.1','#','fa fa-database',1),
('Menu 2.1.1.2','#','fa  fa-users ',1),
('Menu 2.1.2.1','#','fa fa-bars',1)


INSERT INTO menu_tree 
(id, parent_id, group_id )
VALUES
(1,0,0),
(2,1,0),
(3,1,0),
(4,2,0),
(5,2,0),
(6,4,0),
(7,4,0),
(8,5,0),
(9,0,0),
(10,9,0),
(11,9,0),
(12,10,0),
(13,10,0),
(14,11,0),
(15,11,0),
(16,13,0)

SELECT a.id, a.parent_id, b.nama, b.url, b.class_icon FROM menu_tree a
JOIN menu b ON a.id = b.id




