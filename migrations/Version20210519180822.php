<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210519180822 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE child_filter (id INT AUTO_INCREMENT NOT NULL, max_year INT DEFAULT NULL, max_age_limit INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE child_filter_janre (child_filter_id INT NOT NULL, janre_id INT NOT NULL, INDEX IDX_11F1A492A4D2D2 (child_filter_id), INDEX IDX_11F1A492DDCE2DD (janre_id), PRIMARY KEY(child_filter_id, janre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE child_filter_janre ADD CONSTRAINT FK_11F1A492A4D2D2 FOREIGN KEY (child_filter_id) REFERENCES child_filter (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE child_filter_janre ADD CONSTRAINT FK_11F1A492DDCE2DD FOREIGN KEY (janre_id) REFERENCES janre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE child ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE child ADD CONSTRAINT FK_22B35429A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_22B35429A76ED395 ON child (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE child_filter_janre DROP FOREIGN KEY FK_11F1A492A4D2D2');
        $this->addSql('DROP TABLE child_filter');
        $this->addSql('DROP TABLE child_filter_janre');
        $this->addSql('ALTER TABLE child DROP FOREIGN KEY FK_22B35429A76ED395');
        $this->addSql('DROP INDEX IDX_22B35429A76ED395 ON child');
        $this->addSql('ALTER TABLE child DROP user_id');
    }
}
