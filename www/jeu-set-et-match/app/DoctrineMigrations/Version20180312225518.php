<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180312225518 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE registration DROP FOREIGN KEY FK_62A8A7A71873FCBB');
        $this->addSql('DROP INDEX idx_62a8a7a71873fcbb ON registration');
        $this->addSql('CREATE INDEX IDX_62A8A7A71873FCBB ON registration (tournamentPlayingCategory_id)');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A71873FCBB FOREIGN KEY (tournamentPlayingCategory_id) REFERENCES tournament_playing_category (idTournamentPlayingCategory)');
        $this->addSql('ALTER TABLE registration_player DROP FOREIGN KEY FK_9A27332799E6F5DF');
        $this->addSql('ALTER TABLE registration_player DROP FOREIGN KEY FK_9A273327833D8F43');
        $this->addSql('DROP INDEX idx_9a273327833d8f43 ON registration_player');
        $this->addSql('CREATE INDEX IDX_3647BA8F833D8F43 ON registration_player (registration_id)');
        $this->addSql('DROP INDEX idx_9a27332799e6f5df ON registration_player');
        $this->addSql('CREATE INDEX IDX_3647BA8F99E6F5DF ON registration_player (player_id)');
        $this->addSql('ALTER TABLE registration_player ADD CONSTRAINT FK_9A27332799E6F5DF FOREIGN KEY (player_id) REFERENCES player (idPlayer)');
        $this->addSql('ALTER TABLE registration_player ADD CONSTRAINT FK_9A273327833D8F43 FOREIGN KEY (registration_id) REFERENCES registration (idRegistration)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE registration DROP FOREIGN KEY FK_62A8A7A71873FCBB');
        $this->addSql('DROP INDEX idx_62a8a7a71873fcbb ON registration');
        $this->addSql('CREATE INDEX FK_62A8A7A71873FCBB ON registration (tournamentPlayingCategory_id)');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A71873FCBB FOREIGN KEY (tournamentPlayingCategory_id) REFERENCES tournament_playing_category (idTournamentPlayingCategory)');
        $this->addSql('ALTER TABLE registration_player DROP FOREIGN KEY FK_3647BA8F833D8F43');
        $this->addSql('ALTER TABLE registration_player DROP FOREIGN KEY FK_3647BA8F99E6F5DF');
        $this->addSql('DROP INDEX idx_3647ba8f833d8f43 ON registration_player');
        $this->addSql('CREATE INDEX IDX_9A273327833D8F43 ON registration_player (registration_id)');
        $this->addSql('DROP INDEX idx_3647ba8f99e6f5df ON registration_player');
        $this->addSql('CREATE INDEX IDX_9A27332799E6F5DF ON registration_player (player_id)');
        $this->addSql('ALTER TABLE registration_player ADD CONSTRAINT FK_3647BA8F833D8F43 FOREIGN KEY (registration_id) REFERENCES registration (idRegistration)');
        $this->addSql('ALTER TABLE registration_player ADD CONSTRAINT FK_3647BA8F99E6F5DF FOREIGN KEY (player_id) REFERENCES player (idPlayer)');
    }
}
