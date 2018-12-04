<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180210010009 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE country (idCountry INT AUTO_INCREMENT NOT NULL, code VARCHAR(3) NOT NULL, countryName VARCHAR(45) NOT NULL, UNIQUE INDEX UNIQ_5373C96677153098 (code), PRIMARY KEY(idCountry)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fixture (tournament_id INT DEFAULT NULL, referee_id INT DEFAULT NULL, first_registration_id INT DEFAULT NULL, second_registration_id INT DEFAULT NULL, idFixture INT AUTO_INCREMENT NOT NULL, round INT NOT NULL, startDate DATETIME DEFAULT NULL, endDate DATETIME DEFAULT NULL, INDEX IDX_5E540EE33D1A3E7 (tournament_id), INDEX IDX_5E540EE4A087CA2 (referee_id), INDEX IDX_5E540EE29DD9126 (first_registration_id), INDEX IDX_5E540EED095302E (second_registration_id), PRIMARY KEY(idFixture)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fixture_result (fixture_id INT DEFAULT NULL, winner_registration_id INT DEFAULT NULL, idFixtureResult INT AUTO_INCREMENT NOT NULL, INDEX IDX_6174492BE524616D (fixture_id), INDEX IDX_6174492B973E750D (winner_registration_id), PRIMARY KEY(idFixtureResult)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_score (fixture_id INT DEFAULT NULL, idGameScore INT AUTO_INCREMENT NOT NULL, setNumber INT NOT NULL, gameNumber INT NOT NULL, firstRegistrationPoint INT NOT NULL, secondRegistrationPoint INT NOT NULL, INDEX IDX_AA4EDEE524616D (fixture_id), PRIMARY KEY(idGameScore)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player (country_id INT DEFAULT NULL, idPlayer INT AUTO_INCREMENT NOT NULL, firstName VARCHAR(45) NOT NULL, lastName VARCHAR(45) NOT NULL, gender VARCHAR(1) NOT NULL, dateOfBirth DATE NOT NULL, INDEX IDX_98197A65F92F3E70 (country_id), PRIMARY KEY(idPlayer)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE registration (tournament_id INT DEFAULT NULL, player_id INT DEFAULT NULL, idRegistration INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, INDEX IDX_62A8A7A733D1A3E7 (tournament_id), INDEX IDX_62A8A7A799E6F5DF (player_id), PRIMARY KEY(idRegistration)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE set_score (fixture_id INT DEFAULT NULL, idSetScore INT AUTO_INCREMENT NOT NULL, setNumber INT NOT NULL, firstRegistrationGames INT NOT NULL, secondRegistrationGames INT NOT NULL, INDEX IDX_A668CB37E524616D (fixture_id), PRIMARY KEY(idSetScore)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE surface_type (idSurfaceType INT AUTO_INCREMENT NOT NULL, surfaceType VARCHAR(30) NOT NULL, PRIMARY KEY(idSurfaceType)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tie_break (fixture_id INT DEFAULT NULL, idTieBreak INT AUTO_INCREMENT NOT NULL, setNumber INT NOT NULL, firstRegistrationPoint INT NOT NULL, secondRegistrationPoint INT NOT NULL, INDEX IDX_6AEA4340E524616D (fixture_id), PRIMARY KEY(idTieBreak)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tournament (surface_type_id INT DEFAULT NULL, idTournament INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, location VARCHAR(45) NOT NULL, startDate DATE NOT NULL, endDate DATE NOT NULL, numberOfRounds INT NOT NULL, INDEX IDX_BD5FB8D9DAA1EEDA (surface_type_id), PRIMARY KEY(idTournament)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', idUser INT AUTO_INCREMENT NOT NULL, firstName VARCHAR(45) NOT NULL, lastName VARCHAR(45) NOT NULL, dateOfBirth DATE NOT NULL, phoneNumber VARCHAR(12) NOT NULL, UNIQUE INDEX UNIQ_8D93D64992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_8D93D649A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_8D93D649C05FB297 (confirmation_token), PRIMARY KEY(idUser)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fixture ADD CONSTRAINT FK_5E540EE33D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (idTournament)');
        $this->addSql('ALTER TABLE fixture ADD CONSTRAINT FK_5E540EE4A087CA2 FOREIGN KEY (referee_id) REFERENCES user (idUser)');
        $this->addSql('ALTER TABLE fixture ADD CONSTRAINT FK_5E540EE29DD9126 FOREIGN KEY (first_registration_id) REFERENCES registration (idRegistration)');
        $this->addSql('ALTER TABLE fixture ADD CONSTRAINT FK_5E540EED095302E FOREIGN KEY (second_registration_id) REFERENCES registration (idRegistration)');
        $this->addSql('ALTER TABLE fixture_result ADD CONSTRAINT FK_6174492BE524616D FOREIGN KEY (fixture_id) REFERENCES fixture (idFixture)');
        $this->addSql('ALTER TABLE fixture_result ADD CONSTRAINT FK_6174492B973E750D FOREIGN KEY (winner_registration_id) REFERENCES registration (idRegistration)');
        $this->addSql('ALTER TABLE game_score ADD CONSTRAINT FK_AA4EDEE524616D FOREIGN KEY (fixture_id) REFERENCES fixture (idFixture)');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65F92F3E70 FOREIGN KEY (country_id) REFERENCES country (idCountry)');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A733D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (idTournament)');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A799E6F5DF FOREIGN KEY (player_id) REFERENCES player (idPlayer)');
        $this->addSql('ALTER TABLE set_score ADD CONSTRAINT FK_A668CB37E524616D FOREIGN KEY (fixture_id) REFERENCES fixture (idFixture)');
        $this->addSql('ALTER TABLE tie_break ADD CONSTRAINT FK_6AEA4340E524616D FOREIGN KEY (fixture_id) REFERENCES fixture (idFixture)');
        $this->addSql('ALTER TABLE tournament ADD CONSTRAINT FK_BD5FB8D9DAA1EEDA FOREIGN KEY (surface_type_id) REFERENCES surface_type (idSurfaceType)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A65F92F3E70');
        $this->addSql('ALTER TABLE fixture_result DROP FOREIGN KEY FK_6174492BE524616D');
        $this->addSql('ALTER TABLE game_score DROP FOREIGN KEY FK_AA4EDEE524616D');
        $this->addSql('ALTER TABLE set_score DROP FOREIGN KEY FK_A668CB37E524616D');
        $this->addSql('ALTER TABLE tie_break DROP FOREIGN KEY FK_6AEA4340E524616D');
        $this->addSql('ALTER TABLE registration DROP FOREIGN KEY FK_62A8A7A799E6F5DF');
        $this->addSql('ALTER TABLE fixture DROP FOREIGN KEY FK_5E540EE29DD9126');
        $this->addSql('ALTER TABLE fixture DROP FOREIGN KEY FK_5E540EED095302E');
        $this->addSql('ALTER TABLE fixture_result DROP FOREIGN KEY FK_6174492B973E750D');
        $this->addSql('ALTER TABLE tournament DROP FOREIGN KEY FK_BD5FB8D9DAA1EEDA');
        $this->addSql('ALTER TABLE fixture DROP FOREIGN KEY FK_5E540EE33D1A3E7');
        $this->addSql('ALTER TABLE registration DROP FOREIGN KEY FK_62A8A7A733D1A3E7');
        $this->addSql('ALTER TABLE fixture DROP FOREIGN KEY FK_5E540EE4A087CA2');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE fixture');
        $this->addSql('DROP TABLE fixture_result');
        $this->addSql('DROP TABLE game_score');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE registration');
        $this->addSql('DROP TABLE set_score');
        $this->addSql('DROP TABLE surface_type');
        $this->addSql('DROP TABLE tie_break');
        $this->addSql('DROP TABLE tournament');
        $this->addSql('DROP TABLE user');
    }
}
