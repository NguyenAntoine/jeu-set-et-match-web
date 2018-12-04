<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180318010415 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fixture_result DROP FOREIGN KEY FK_6174492BE524616D');
        $this->addSql('ALTER TABLE fixture_result ADD CONSTRAINT FK_6174492BE524616D FOREIGN KEY (fixture_id) REFERENCES fixture (idFixture) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_score DROP FOREIGN KEY FK_AA4EDE18796F9D');
        $this->addSql('ALTER TABLE game_score ADD CONSTRAINT FK_AA4EDE18796F9D FOREIGN KEY (setScore_id) REFERENCES set_score (idSetScore) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_stat DROP FOREIGN KEY FK_CBAD930DA17F655');
        $this->addSql('ALTER TABLE game_stat ADD CONSTRAINT FK_CBAD930DA17F655 FOREIGN KEY (gameScore_id) REFERENCES game_score (idGameScore) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ranking DROP FOREIGN KEY FK_80B839D099E6F5DF');
        $this->addSql('ALTER TABLE ranking ADD CONSTRAINT FK_80B839D099E6F5DF FOREIGN KEY (player_id) REFERENCES player (idPlayer) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE set_score DROP FOREIGN KEY FK_A668CB37E524616D');
        $this->addSql('ALTER TABLE set_score ADD CONSTRAINT FK_A668CB37E524616D FOREIGN KEY (fixture_id) REFERENCES fixture (idFixture) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fixture_result DROP FOREIGN KEY FK_6174492BE524616D');
        $this->addSql('ALTER TABLE fixture_result ADD CONSTRAINT FK_6174492BE524616D FOREIGN KEY (fixture_id) REFERENCES fixture (idFixture)');
        $this->addSql('ALTER TABLE game_score DROP FOREIGN KEY FK_AA4EDE18796F9D');
        $this->addSql('ALTER TABLE game_score ADD CONSTRAINT FK_AA4EDE18796F9D FOREIGN KEY (setScore_id) REFERENCES set_score (idSetScore)');
        $this->addSql('ALTER TABLE game_stat DROP FOREIGN KEY FK_CBAD930DA17F655');
        $this->addSql('ALTER TABLE game_stat ADD CONSTRAINT FK_CBAD930DA17F655 FOREIGN KEY (gameScore_id) REFERENCES game_score (idGameScore)');
        $this->addSql('ALTER TABLE ranking DROP FOREIGN KEY FK_80B839D099E6F5DF');
        $this->addSql('ALTER TABLE ranking ADD CONSTRAINT FK_80B839D099E6F5DF FOREIGN KEY (player_id) REFERENCES player (idPlayer)');
        $this->addSql('ALTER TABLE set_score DROP FOREIGN KEY FK_A668CB37E524616D');
        $this->addSql('ALTER TABLE set_score ADD CONSTRAINT FK_A668CB37E524616D FOREIGN KEY (fixture_id) REFERENCES fixture (idFixture)');
    }
}
