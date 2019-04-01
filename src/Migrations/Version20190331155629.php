<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190331155629 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE members ADD rank_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE members ADD CONSTRAINT FK_45A0D2FF5240D1CA FOREIGN KEY (rank_id_id) REFERENCES ranks (id)');
        $this->addSql('CREATE INDEX IDX_45A0D2FF5240D1CA ON members (rank_id_id)');
        $this->addSql('ALTER TABLE ranks DROP libelle');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE members DROP FOREIGN KEY FK_45A0D2FF5240D1CA');
        $this->addSql('DROP INDEX IDX_45A0D2FF5240D1CA ON members');
        $this->addSql('ALTER TABLE members DROP rank_id_id');
        $this->addSql('ALTER TABLE ranks ADD libelle VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
