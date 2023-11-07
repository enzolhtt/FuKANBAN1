<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231107081923 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE taches (id INT AUTO_INCREMENT NOT NULL, statut_id INT DEFAULT NULL, projet_id INT DEFAULT NULL, utilisateur_id INT DEFAULT NULL, titre_tache VARCHAR(255) NOT NULL, description_tache VARCHAR(255) NOT NULL, INDEX IDX_3BF2CD98F6203804 (statut_id), INDEX IDX_3BF2CD98C18272 (projet_id), INDEX IDX_3BF2CD98FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE taches ADD CONSTRAINT FK_3BF2CD98F6203804 FOREIGN KEY (statut_id) REFERENCES statut (id)');
        $this->addSql('ALTER TABLE taches ADD CONSTRAINT FK_3BF2CD98C18272 FOREIGN KEY (projet_id) REFERENCES projets (id)');
        $this->addSql('ALTER TABLE taches ADD CONSTRAINT FK_3BF2CD98FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE taches DROP FOREIGN KEY FK_3BF2CD98F6203804');
        $this->addSql('ALTER TABLE taches DROP FOREIGN KEY FK_3BF2CD98C18272');
        $this->addSql('ALTER TABLE taches DROP FOREIGN KEY FK_3BF2CD98FB88E14F');
        $this->addSql('DROP TABLE taches');
    }
}
