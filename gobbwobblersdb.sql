/**
* SQL Database for M2M Assessment
* Group: Gobbwobblers
* Author: Yasin Patel (p2437884)
* 
* `messages` table stores information regarding messages and the state of the circuit board on the M2M server.
* `users` table stores information regarding the users and their details.
* `log` table stores information regarding any logs that occur and the details of the error.
*
*/
/*USE p2437884db;*/

DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
    `id`  INT(10) ZEROFILL NOT NULL AUTO_INCREMENT,
    `timestamp` timestamp NOT NULL,
    `phonenumber` BIGINT(13) NOT NULL,
    `heater1` VARCHAR(10) NOT NULL,
    `fan1` VARCHAR(5)  NOT NULL,
    `name` VARCHAR(45) COLLATE utf8_bin DEFAULT NULL,
    `email` VARCHAR(145) COLLATE utf8_bin DEFAULT NULL,
    `sw1` VARCHAR(5)  NOT NULL,
    `sw2` VARCHAR(5)  NOT NULL,
    `sw3` VARCHAR(5)  NOT NULL,
    `sw4` VARCHAR(5)  NOT NULL,
    `keypad` INT(4) NOT NULL,
    CONSTRAINT message_PK PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`(
    `id` INT(10) ZEROFILL NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(64) COLLATE utf8_bin NOT NULL,
    `password` VARCHAR(128) COLLATE utf8_bin NOT NULL,
    `passwordSalt` VARCHAR(200) COLLATE utf8_bin NOT NULL,
    `firstname` VARCHAR(64) COLLATE utf8_bin DEFAULT NULL,
    `surname` VARCHAR(64) COLLATE utf8_bin DEFAULT NULL,
    `email` VARCHAR(256) COLLATE utf8_bin NOT NULL,
    `key` VARCHAR(256) COLLATE utf8_bin DEFAULT NULL,
    `lastlogin` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    PRIMARY KEY (`id`),
	UNIQUE KEY `id` (`id`),
	UNIQUE KEY `username` (`username`),
	UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
    `id` int(10) ZEROFILL NOT NULL AUTO_INCREMENT,
    `message` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
    `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `users` (`username`, `password`, `passwordSalt`, `firstname`, `surname`, `email`)
VALUES ('yasin', '2ef49a5a490570b6b9d48891ee3689b32c842a30f2331f8e0f701f16ca28a9909ba9cd7061c4989b8b37b00f7ade91ddb34ee03529565cc5d9d604b7485610bb', '+FnMiQNQ3hoyZ+WCA01J7C6DbsD8y+PeljcgFNMjW0U=', 'Yasin', 'Patel', 'p2437884@my365.dmu.ac.uk');

INSERT INTO `users` (`username`, `password`, `passwordSalt`, `firstname`, `surname`, `email`)
VALUES ('lewis', 'a256734dabb20116f29a581eadd84eb7622e4b2a0e05655492041896d4595ace8cb90bcaec3c01a40b1bdd7eee5de1355f2b7a2d0d9a7474d4f3bcf3defb6977', '0vSSDiMFdGEIU4Qfx6hDsOyG0zSU9hZ3Tbz7A+v5p5g=', 'Lewis', 'Harris', 'p2419279@my365.dmu.ac.uk');

INSERT INTO `users` (`username`, `password`, `passwordSalt`, `firstname`, `surname`, `email`)
VALUES ('daniel', '01bca8561dab43b51de6c278c024100916b9a7444652b8f817574d4e7cbca4ae7b137ca0d6269e44b5b1c38aeaf054fea24ff3a0f33db804e639b7def3eb3574', 'HjAKimICgSs7s9XHPZG+dvbYXLv+GEdbBGHkiLh68f0=', 'Daniel', 'OHara', 'p2435725@my365.dmu.ac.uk');