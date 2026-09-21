<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260921072218 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo CHANGE microscope_id microscope_id INT NOT NULL, CHANGE technique_id technique_id INT NOT NULL, CHANGE relative_age_id relative_age_id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo CHANGE microscope_id microscope_id INT DEFAULT NULL, CHANGE technique_id technique_id INT DEFAULT NULL, CHANGE relative_age_id relative_age_id INT DEFAULT NULL');
    }
}
