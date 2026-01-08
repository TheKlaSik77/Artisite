ALTER TABLE craftman ADD category_id INT;

UPDATE craftman SET category_id = 1;

ALTER TABLE craftman
ADD CONSTRAINT fk_craftman_category
FOREIGN KEY (category_id)
REFERENCES category(category_id)
ON UPDATE CASCADE;