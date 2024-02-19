-- Drop user first if they exist
DROP USER if exists 'marquepage'@'%' ;

-- Now create user with prop privileges
CREATE USER 'marquepage'@'%' IDENTIFIED BY 'marquepage';

GRANT ALL PRIVILEGES ON * . * TO 'avengers_gregory'@'%';