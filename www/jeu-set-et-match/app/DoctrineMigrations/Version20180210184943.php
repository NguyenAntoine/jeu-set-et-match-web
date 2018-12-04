<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180210184943 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE game_score DROP FOREIGN KEY FK_AA4EDEE524616D');
        $this->addSql('DROP INDEX IDX_AA4EDEE524616D ON game_score');
        $this->addSql('ALTER TABLE game_score DROP fixture_id');
        $this->addSql('ALTER TABLE tie_break DROP FOREIGN KEY FK_6AEA4340E524616D');
        $this->addSql('DROP INDEX IDX_6AEA4340E524616D ON tie_break');
        $this->addSql('ALTER TABLE tie_break DROP fixture_id');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE game_score ADD fixture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game_score ADD CONSTRAINT FK_AA4EDEE524616D FOREIGN KEY (fixture_id) REFERENCES fixture (idFixture)');
        $this->addSql('CREATE INDEX IDX_AA4EDEE524616D ON game_score (fixture_id)');
        $this->addSql('ALTER TABLE tie_break ADD fixture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tie_break ADD CONSTRAINT FK_6AEA4340E524616D FOREIGN KEY (fixture_id) REFERENCES fixture (idFixture)');
        $this->addSql('CREATE INDEX IDX_6AEA4340E524616D ON tie_break (fixture_id)');
    }
}
