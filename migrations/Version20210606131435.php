<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210606131435 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD filter_id INT DEFAULT NULL, ADD parent_id INT DEFAULT NULL, ADD child_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D395B25E FOREIGN KEY (filter_id) REFERENCES child_filter (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649D395B25E ON user (filter_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D395B25E');
        $this->addSql('DROP INDEX UNIQ_8D93D649D395B25E ON user');
        $this->addSql('ALTER TABLE user DROP filter_id, DROP parent_id, DROP child_id');
    }
}
