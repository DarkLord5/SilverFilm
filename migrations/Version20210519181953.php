<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210519181953 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE child ADD filter_id INT NOT NULL');
        $this->addSql('ALTER TABLE child ADD CONSTRAINT FK_22B35429D395B25E FOREIGN KEY (filter_id) REFERENCES child_filter (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_22B35429D395B25E ON child (filter_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE child DROP FOREIGN KEY FK_22B35429D395B25E');
        $this->addSql('DROP INDEX UNIQ_22B35429D395B25E ON child');
        $this->addSql('ALTER TABLE child DROP filter_id');
    }
}
