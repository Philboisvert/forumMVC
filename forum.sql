CREATE TABLE `usager` (
    `username` varchar(30) NOT NULL,
    `password` varchar(255) NOT NULL,
    `banni` bool NOT NULL,
    `admin` bool NOT NULL,
    PRIMARY KEY(`username`)
    ON DELETE CASCADE
);

CREATE TABLE `sujets` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `titre` varchar(250) NOT NULL,
    `texte` text NOT NULL,
    `dateCreation` datetime NOT NULL,
    `idUsager` varchar(30) NOT NULL,
    PRIMARY KEY(`id`),
    FOREIGN KEY(`idUsager`) REFERENCES `usager`(`username`)
    ON DELETE CASCADE
);

CREATE TABLE `reponse` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `titre` varchar(250) NOT NULL,
    `texte` text NOT NULL,
    `dateCreation` datetime NOT NULL,
    `idUsager` varchar(30) NOT NULL,
    `idSujet` int(11) NOT NULL,
    PRIMARY KEY(`id`),
    FOREIGN KEY(`idUsager`) REFERENCES `usager`(`username`),
    FOREIGN KEY(`idSujet`) REFERENCES `sujets`(`id`)
);
/* infos de l'admin GHarvey//mot de passe: salut */
INSERT INTO usager VALUES 
("GHarvey","$2y$10$jZPyB5Zn1Uk.X3ZQ7UhyQe7063L1u/s.kps.jrbQjRXPongWOM4QS",0,1);

