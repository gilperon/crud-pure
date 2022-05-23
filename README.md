Tutorial

Clone this repository<br>
git clone https://github.com/gilperon/crud-pure.git

And open the php file, and create the tables

    CREATE TABLE `customers` (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    `firstName` varchar(100) NOT NULL ,
    `lastName` varchar(100) NOT NULL ,
    `phone` varchar(10) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

    CREATE TABLE `addresses` (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    `customerId` INT(10) UNSIGNED ,
    `address` varchar(255) NOT NULL ,
    FOREIGN KEY (customerId) REFERENCES customers(id)
    ON UPDATE CASCADE
    ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
