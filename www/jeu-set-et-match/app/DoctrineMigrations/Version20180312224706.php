<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180312224706 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE court (tournament_id INT DEFAULT NULL, idCourt INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, INDEX IDX_63AE193F33D1A3E7 (tournament_id), PRIMARY KEY(idCourt)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_stat (stat_id INT DEFAULT NULL, registration_id INT DEFAULT NULL, idGameStat INT AUTO_INCREMENT NOT NULL, datetime DATETIME NOT NULL, gameScore_id INT DEFAULT NULL, INDEX IDX_CBAD930DA17F655 (gameScore_id), INDEX IDX_CBAD930D9502F0B (stat_id), INDEX IDX_CBAD930D833D8F43 (registration_id), PRIMARY KEY(idGameStat)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playing_category (idPlayingCategory INT AUTO_INCREMENT NOT NULL, categoryName VARCHAR(45) NOT NULL, PRIMARY KEY(idPlayingCategory)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ranking (player_id INT DEFAULT NULL, idRanking INT AUTO_INCREMENT NOT NULL, score INT NOT NULL, UNIQUE INDEX UNIQ_80B839D099E6F5DF (player_id), PRIMARY KEY(idRanking)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE registration_player (registration_id INT DEFAULT NULL, player_id INT DEFAULT NULL, idRegistrationPlayer INT AUTO_INCREMENT NOT NULL, INDEX IDX_9A273327833D8F43 (registration_id), INDEX IDX_9A27332799E6F5DF (player_id), PRIMARY KEY(idRegistrationPlayer)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stat (idStat INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, PRIMARY KEY(idStat)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tournament_playing_category (tournament_id INT DEFAULT NULL, idTournamentPlayingCategory INT AUTO_INCREMENT NOT NULL, playingCategory_id INT DEFAULT NULL, INDEX IDX_F116BD2B33D1A3E7 (tournament_id), INDEX IDX_F116BD2BDA803556 (playingCategory_id), PRIMARY KEY(idTournamentPlayingCategory)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE court ADD CONSTRAINT FK_63AE193F33D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (idTournament)');
        $this->addSql('ALTER TABLE game_stat ADD CONSTRAINT FK_CBAD930DA17F655 FOREIGN KEY (gameScore_id) REFERENCES game_score (idGameScore)');
        $this->addSql('ALTER TABLE game_stat ADD CONSTRAINT FK_CBAD930D9502F0B FOREIGN KEY (stat_id) REFERENCES stat (idStat)');
        $this->addSql('ALTER TABLE game_stat ADD CONSTRAINT FK_CBAD930D833D8F43 FOREIGN KEY (registration_id) REFERENCES registration (idRegistration)');
        $this->addSql('ALTER TABLE ranking ADD CONSTRAINT FK_80B839D099E6F5DF FOREIGN KEY (player_id) REFERENCES player (idPlayer)');
        $this->addSql('ALTER TABLE registration_player ADD CONSTRAINT FK_9A273327833D8F43 FOREIGN KEY (registration_id) REFERENCES registration (idRegistration)');
        $this->addSql('ALTER TABLE registration_player ADD CONSTRAINT FK_9A27332799E6F5DF FOREIGN KEY (player_id) REFERENCES player (idPlayer)');
        $this->addSql('ALTER TABLE tournament_playing_category ADD CONSTRAINT FK_F116BD2B33D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (idTournament)');
        $this->addSql('ALTER TABLE tournament_playing_category ADD CONSTRAINT FK_F116BD2BDA803556 FOREIGN KEY (playingCategory_id) REFERENCES playing_category (idPlayingCategory)');
        $this->addSql('DROP TABLE tie_break');
        $this->addSql('ALTER TABLE fixture DROP FOREIGN KEY FK_5E540EE29DD9126');
        $this->addSql('ALTER TABLE fixture DROP FOREIGN KEY FK_5E540EE33D1A3E7');
        $this->addSql('ALTER TABLE fixture DROP FOREIGN KEY FK_5E540EED095302E');
        $this->addSql('DROP INDEX IDX_5E540EE33D1A3E7 ON fixture');
        $this->addSql('DROP INDEX IDX_5E540EE29DD9126 ON fixture');
        $this->addSql('DROP INDEX IDX_5E540EED095302E ON fixture');
        $this->addSql('ALTER TABLE fixture ADD court_id INT DEFAULT NULL, ADD fixtureBall INT NOT NULL, ADD firstRegistration_id INT DEFAULT NULL, ADD secondRegistration_id INT DEFAULT NULL, ADD tournamentPlayingCategory_id INT DEFAULT NULL, DROP first_registration_id, DROP tournament_id, DROP second_registration_id');
        $this->addSql('ALTER TABLE fixture ADD CONSTRAINT FK_5E540EE3DD3D63C FOREIGN KEY (firstRegistration_id) REFERENCES registration (idRegistration)');
        $this->addSql('ALTER TABLE fixture ADD CONSTRAINT FK_5E540EECCADB1A0 FOREIGN KEY (secondRegistration_id) REFERENCES registration (idRegistration)');
        $this->addSql('ALTER TABLE fixture ADD CONSTRAINT FK_5E540EEE3184009 FOREIGN KEY (court_id) REFERENCES court (idCourt)');
        $this->addSql('ALTER TABLE fixture ADD CONSTRAINT FK_5E540EE1873FCBB FOREIGN KEY (tournamentPlayingCategory_id) REFERENCES tournament_playing_category (idTournamentPlayingCategory)');
        $this->addSql('CREATE INDEX IDX_5E540EE3DD3D63C ON fixture (firstRegistration_id)');
        $this->addSql('CREATE INDEX IDX_5E540EECCADB1A0 ON fixture (secondRegistration_id)');
        $this->addSql('CREATE INDEX IDX_5E540EEE3184009 ON fixture (court_id)');
        $this->addSql('CREATE INDEX IDX_5E540EE1873FCBB ON fixture (tournamentPlayingCategory_id)');
        $this->addSql('ALTER TABLE fixture_result DROP FOREIGN KEY FK_6174492B973E750D');
        $this->addSql('DROP INDEX IDX_6174492B973E750D ON fixture_result');
        $this->addSql('ALTER TABLE fixture_result CHANGE winner_registration_id winnerRegistration_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fixture_result ADD CONSTRAINT FK_6174492BD527ED4E FOREIGN KEY (winnerRegistration_id) REFERENCES registration (idRegistration)');
        $this->addSql('CREATE INDEX IDX_6174492BD527ED4E ON fixture_result (winnerRegistration_id)');
        $this->addSql('ALTER TABLE game_score ADD gameBall INT NOT NULL, ADD playerServing INT NOT NULL');
        $this->addSql('ALTER TABLE registration DROP FOREIGN KEY FK_62A8A7A733D1A3E7');
        $this->addSql('ALTER TABLE registration DROP FOREIGN KEY FK_62A8A7A799E6F5DF');
        $this->addSql('DROP INDEX IDX_62A8A7A733D1A3E7 ON registration');
        $this->addSql('DROP INDEX IDX_62A8A7A799E6F5DF ON registration');
        $this->addSql('ALTER TABLE registration ADD name VARCHAR(45) NOT NULL, ADD tournamentPlayingCategory_id INT DEFAULT NULL, DROP tournament_id, DROP player_id, DROP date');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A71873FCBB FOREIGN KEY (tournamentPlayingCategory_id) REFERENCES tournament_playing_category (idTournamentPlayingCategory)');
        $this->addSql('CREATE INDEX IDX_62A8A7A71873FCBB ON registration (tournamentPlayingCategory_id)');
        $this->addSql('ALTER TABLE set_score ADD setBall INT NOT NULL');
        $this->addSql('ALTER TABLE tournament DROP FOREIGN KEY FK_BD5FB8D9DAA1EEDA');
        $this->addSql('DROP INDEX IDX_BD5FB8D9DAA1EEDA ON tournament');
        $this->addSql('ALTER TABLE tournament CHANGE surface_type_id surfaceType_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tournament ADD CONSTRAINT FK_BD5FB8D9C423755F FOREIGN KEY (surfaceType_id) REFERENCES surface_type (idSurfaceType)');
        $this->addSql('CREATE INDEX IDX_BD5FB8D9C423755F ON tournament (surfaceType_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fixture DROP FOREIGN KEY FK_5E540EEE3184009');
        $this->addSql('ALTER TABLE tournament_playing_category DROP FOREIGN KEY FK_F116BD2BDA803556');
        $this->addSql('ALTER TABLE game_stat DROP FOREIGN KEY FK_CBAD930D9502F0B');
        $this->addSql('ALTER TABLE fixture DROP FOREIGN KEY FK_5E540EE1873FCBB');
        $this->addSql('ALTER TABLE registration DROP FOREIGN KEY FK_62A8A7A71873FCBB');
        $this->addSql('CREATE TABLE tie_break (idTieBreak INT AUTO_INCREMENT NOT NULL, firstRegistrationPoint INT NOT NULL, secondRegistrationPoint INT NOT NULL, setScore_id INT DEFAULT NULL, INDEX IDX_6AEA434018796F9D (setScore_id), PRIMARY KEY(idTieBreak)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tie_break ADD CONSTRAINT FK_6AEA434018796F9D FOREIGN KEY (setScore_id) REFERENCES set_score (idSetScore)');
        $this->addSql('DROP TABLE court');
        $this->addSql('DROP TABLE game_stat');
        $this->addSql('DROP TABLE playing_category');
        $this->addSql('DROP TABLE ranking');
        $this->addSql('DROP TABLE registration_player');
        $this->addSql('DROP TABLE stat');
        $this->addSql('DROP TABLE tournament_playing_category');
        $this->addSql('ALTER TABLE fixture DROP FOREIGN KEY FK_5E540EE3DD3D63C');
        $this->addSql('ALTER TABLE fixture DROP FOREIGN KEY FK_5E540EECCADB1A0');
        $this->addSql('DROP INDEX IDX_5E540EE3DD3D63C ON fixture');
        $this->addSql('DROP INDEX IDX_5E540EECCADB1A0 ON fixture');
        $this->addSql('DROP INDEX IDX_5E540EEE3184009 ON fixture');
        $this->addSql('DROP INDEX IDX_5E540EE1873FCBB ON fixture');
        $this->addSql('ALTER TABLE fixture ADD first_registration_id INT DEFAULT NULL, ADD tournament_id INT DEFAULT NULL, ADD second_registration_id INT DEFAULT NULL, DROP court_id, DROP fixtureBall, DROP firstRegistration_id, DROP secondRegistration_id, DROP tournamentPlayingCategory_id');
        $this->addSql('ALTER TABLE fixture ADD CONSTRAINT FK_5E540EE29DD9126 FOREIGN KEY (first_registration_id) REFERENCES registration (idRegistration)');
        $this->addSql('ALTER TABLE fixture ADD CONSTRAINT FK_5E540EE33D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (idTournament)');
        $this->addSql('ALTER TABLE fixture ADD CONSTRAINT FK_5E540EED095302E FOREIGN KEY (second_registration_id) REFERENCES registration (idRegistration)');
        $this->addSql('CREATE INDEX IDX_5E540EE33D1A3E7 ON fixture (tournament_id)');
        $this->addSql('CREATE INDEX IDX_5E540EE29DD9126 ON fixture (first_registration_id)');
        $this->addSql('CREATE INDEX IDX_5E540EED095302E ON fixture (second_registration_id)');
        $this->addSql('ALTER TABLE fixture_result DROP FOREIGN KEY FK_6174492BD527ED4E');
        $this->addSql('DROP INDEX IDX_6174492BD527ED4E ON fixture_result');
        $this->addSql('ALTER TABLE fixture_result CHANGE winnerregistration_id winner_registration_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fixture_result ADD CONSTRAINT FK_6174492B973E750D FOREIGN KEY (winner_registration_id) REFERENCES registration (idRegistration)');
        $this->addSql('CREATE INDEX IDX_6174492B973E750D ON fixture_result (winner_registration_id)');
        $this->addSql('ALTER TABLE game_score DROP gameBall, DROP playerServing');
        $this->addSql('DROP INDEX IDX_62A8A7A71873FCBB ON registration');
        $this->addSql('ALTER TABLE registration ADD player_id INT DEFAULT NULL, ADD date DATE NOT NULL, DROP name, CHANGE tournamentplayingcategory_id tournament_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A733D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (idTournament)');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A799E6F5DF FOREIGN KEY (player_id) REFERENCES player (idPlayer)');
        $this->addSql('CREATE INDEX IDX_62A8A7A733D1A3E7 ON registration (tournament_id)');
        $this->addSql('CREATE INDEX IDX_62A8A7A799E6F5DF ON registration (player_id)');
        $this->addSql('ALTER TABLE set_score DROP setBall');
        $this->addSql('ALTER TABLE tournament DROP FOREIGN KEY FK_BD5FB8D9C423755F');
        $this->addSql('DROP INDEX IDX_BD5FB8D9C423755F ON tournament');
        $this->addSql('ALTER TABLE tournament CHANGE surfacetype_id surface_type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tournament ADD CONSTRAINT FK_BD5FB8D9DAA1EEDA FOREIGN KEY (surface_type_id) REFERENCES surface_type (idSurfaceType)');
        $this->addSql('CREATE INDEX IDX_BD5FB8D9DAA1EEDA ON tournament (surface_type_id)');
    }
}
