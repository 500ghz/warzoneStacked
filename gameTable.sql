CREATE TABLE GameTable (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
player1Name VARCHAR(25) NOT NULL,
player2Name VARCHAR(25) NOT NULL,
player1Score INT NOT NULL,
player2Score INT NOT NULL,
player1Turn INT NOT NULL,
player2Turn INT NOT NULL,
player1MoveX INT NOT NULL,
player1MoveY INT NOT NULL,
player2MoveX INT NOT NULL,
player2MoveY INT NOT NULL
);

insert into GameTable(player1Name)