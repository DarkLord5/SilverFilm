<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210521143217 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE child_films (child_id INT NOT NULL, films_id INT NOT NULL, INDEX IDX_9DEA68C2DD62C21B (child_id), INDEX IDX_9DEA68C2939610EE (films_id), PRIMARY KEY(child_id, films_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_films (user_id INT NOT NULL, films_id INT NOT NULL, INDEX IDX_2C2E3109A76ED395 (user_id), INDEX IDX_2C2E3109939610EE (films_id), PRIMARY KEY(user_id, films_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE child_films ADD CONSTRAINT FK_9DEA68C2DD62C21B FOREIGN KEY (child_id) REFERENCES child (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE child_films ADD CONSTRAINT FK_9DEA68C2939610EE FOREIGN KEY (films_id) REFERENCES films (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_films ADD CONSTRAINT FK_2C2E3109A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_films ADD CONSTRAINT FK_2C2E3109939610EE FOREIGN KEY (films_id) REFERENCES films (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE child_films');
        $this->addSql('DROP TABLE user_films');
    }
}
