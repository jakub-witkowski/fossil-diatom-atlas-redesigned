<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260921071233 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, is_published TINYINT NOT NULL, filename VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, total_times_viewed INT NOT NULL, date_added DATETIME NOT NULL, specimen_numerical_age DOUBLE PRECISION DEFAULT NULL, monthly_views INT DEFAULT NULL, weekly_views INT DEFAULT NULL, taxon_id INT NOT NULL, slide_id INT NOT NULL, microscope_id INT NOT NULL, technique_id INT NOT NULL, relative_age_id INT NOT NULL, INDEX IDX_14B78418DE13F470 (taxon_id), INDEX IDX_14B78418DD5AFB87 (slide_id), INDEX IDX_14B784184609C78A (microscope_id), INDEX IDX_14B784181F8ACB26 (technique_id), INDEX IDX_14B7841886AD25F8 (relative_age_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418DE13F470 FOREIGN KEY (taxon_id) REFERENCES taxon (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418DD5AFB87 FOREIGN KEY (slide_id) REFERENCES slide (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B784184609C78A FOREIGN KEY (microscope_id) REFERENCES microscope (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B784181F8ACB26 FOREIGN KEY (technique_id) REFERENCES technique (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B7841886AD25F8 FOREIGN KEY (relative_age_id) REFERENCES relative_age (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418DE13F470');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418DD5AFB87');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B784184609C78A');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B784181F8ACB26');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B7841886AD25F8');
        $this->addSql('DROP TABLE photo');
    }
}
