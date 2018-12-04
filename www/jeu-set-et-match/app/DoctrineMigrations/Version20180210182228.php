<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180210182228 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE game_score ADD setScore_id INT DEFAULT NULL, DROP setNumber');
        $this->addSql('ALTER TABLE game_score ADD CONSTRAINT FK_AA4EDE18796F9D FOREIGN KEY (setScore_id) REFERENCES set_score (idSetScore)');
        $this->addSql('CREATE INDEX IDX_AA4EDE18796F9D ON game_score (setScore_id)');
        $this->addSql('ALTER TABLE tie_break ADD setScore_id INT DEFAULT NULL, DROP setNumber');
        $this->addSql('ALTER TABLE tie_break ADD CONSTRAINT FK_6AEA434018796F9D FOREIGN KEY (setScore_id) REFERENCES set_score (idSetScore)');
        $this->addSql('CREATE INDEX IDX_6AEA434018796F9D ON tie_break (setScore_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE game_score DROP FOREIGN KEY FK_AA4EDE18796F9D');
        $this->addSql('DROP INDEX IDX_AA4EDE18796F9D ON game_score');
        $this->addSql('ALTER TABLE game_score ADD setNumber INT NOT NULL, DROP setScore_id');
        $this->addSql('ALTER TABLE tie_break DROP FOREIGN KEY FK_6AEA434018796F9D');
        $this->addSql('DROP INDEX IDX_6AEA434018796F9D ON tie_break');
        $this->addSql('ALTER TABLE tie_break ADD setNumber INT NOT NULL, DROP setScore_id');
    }
}
