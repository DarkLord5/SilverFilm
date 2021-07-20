<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210519181526 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE films_janre (films_id INT NOT NULL, janre_id INT NOT NULL, INDEX IDX_1D75E260939610EE (films_id), INDEX IDX_1D75E2602DDCE2DD (janre_id), PRIMARY KEY(films_id, janre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE films_janre ADD CONSTRAINT FK_1D75E260939610EE FOREIGN KEY (films_id) REFERENCES films (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE films_janre ADD CONSTRAINT FK_1D75E2602DDCE2DD FOREIGN KEY (janre_id) REFERENCES janre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE films ADD filename VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE films_janre');
        $this->addSql('ALTER TABLE films DROP filename');
    }
}
