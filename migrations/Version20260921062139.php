<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260921062139 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE camera (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE campaign (id INT AUTO_INCREMENT NOT NULL, abbreviation VARCHAR(255) NOT NULL, full_name VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE geography (id INT AUTO_INCREMENT NOT NULL, feature_primary VARCHAR(255) NOT NULL, feature_secondary VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE microscope (id INT AUTO_INCREMENT NOT NULL, producer_id INT NOT NULL, model_id INT NOT NULL, objective_id INT NOT NULL, camera_id INT NOT NULL, INDEX IDX_2DEFA95289B658FE (producer_id), INDEX IDX_2DEFA9527975B7E7 (model_id), INDEX IDX_2DEFA95273484933 (objective_id), INDEX IDX_2DEFA952B47685CD (camera_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE model (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE objective (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, is_published TINYINT NOT NULL, filename VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, total_times_viewed INT NOT NULL, date_added DATETIME NOT NULL, specimen_numerical_age DOUBLE PRECISION DEFAULT NULL, monthly_views INT DEFAULT NULL, weekly_views INT DEFAULT NULL, taxon_id INT NOT NULL, slide_id INT NOT NULL, microscope_id INT NOT NULL, technique_id INT NOT NULL, relative_age_id INT NOT NULL, INDEX IDX_14B78418DE13F470 (taxon_id), INDEX IDX_14B78418DD5AFB87 (slide_id), INDEX IDX_14B784184609C78A (microscope_id), INDEX IDX_14B784181F8ACB26 (technique_id), INDEX IDX_14B7841886AD25F8 (relative_age_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE producer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE relative_age (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, midpoint_date INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE sample (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) DEFAULT NULL, site_id INT DEFAULT NULL, INDEX IDX_F10B76C3F6BD1646 (site_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE site (id INT AUTO_INCREMENT NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, discriminator VARCHAR(255) NOT NULL, name_or_number_primary VARCHAR(255) DEFAULT NULL, name_or_number_secondary VARCHAR(255) DEFAULT NULL, geography_id INT DEFAULT NULL, campaign_id INT DEFAULT NULL, locality_name VARCHAR(255) DEFAULT NULL, country VARCHAR(255) DEFAULT NULL, INDEX IDX_694309E4F091D9C7 (geography_id), INDEX IDX_694309E4F639F774 (campaign_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE slide (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, sample_id INT NOT NULL, discriminator VARCHAR(255) NOT NULL, INDEX IDX_72EFEE621B1FEA20 (sample_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE taxon (id INT AUTO_INCREMENT NOT NULL, diatom_base LONGTEXT NOT NULL, discriminator VARCHAR(255) NOT NULL, genus_name VARCHAR(255) DEFAULT NULL, genus_authority VARCHAR(255) DEFAULT NULL, genus_publication_date INT DEFAULT NULL, genus_name_for_species VARCHAR(255) DEFAULT NULL, species_name VARCHAR(255) DEFAULT NULL, species_authority VARCHAR(255) DEFAULT NULL, species_publication_date INT DEFAULT NULL, genus_name_for_variety VARCHAR(255) DEFAULT NULL, species_name_for_variety VARCHAR(255) DEFAULT NULL, species_authority_for_variety VARCHAR(255) DEFAULT NULL, variety_name VARCHAR(255) DEFAULT NULL, variety_authority VARCHAR(255) DEFAULT NULL, variety_publication_date INT DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE technique (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE microscope ADD CONSTRAINT FK_2DEFA95289B658FE FOREIGN KEY (producer_id) REFERENCES producer (id)');
        $this->addSql('ALTER TABLE microscope ADD CONSTRAINT FK_2DEFA9527975B7E7 FOREIGN KEY (model_id) REFERENCES model (id)');
        $this->addSql('ALTER TABLE microscope ADD CONSTRAINT FK_2DEFA95273484933 FOREIGN KEY (objective_id) REFERENCES objective (id)');
        $this->addSql('ALTER TABLE microscope ADD CONSTRAINT FK_2DEFA952B47685CD FOREIGN KEY (camera_id) REFERENCES camera (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418DE13F470 FOREIGN KEY (taxon_id) REFERENCES taxon (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418DD5AFB87 FOREIGN KEY (slide_id) REFERENCES slide (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B784184609C78A FOREIGN KEY (microscope_id) REFERENCES microscope (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B784181F8ACB26 FOREIGN KEY (technique_id) REFERENCES technique (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B7841886AD25F8 FOREIGN KEY (relative_age_id) REFERENCES relative_age (id)');
        $this->addSql('ALTER TABLE sample ADD CONSTRAINT FK_F10B76C3F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id)');
        $this->addSql('ALTER TABLE site ADD CONSTRAINT FK_694309E4F091D9C7 FOREIGN KEY (geography_id) REFERENCES geography (id)');
        $this->addSql('ALTER TABLE site ADD CONSTRAINT FK_694309E4F639F774 FOREIGN KEY (campaign_id) REFERENCES campaign (id)');
        $this->addSql('ALTER TABLE slide ADD CONSTRAINT FK_72EFEE621B1FEA20 FOREIGN KEY (sample_id) REFERENCES sample (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE microscope DROP FOREIGN KEY FK_2DEFA95289B658FE');
        $this->addSql('ALTER TABLE microscope DROP FOREIGN KEY FK_2DEFA9527975B7E7');
        $this->addSql('ALTER TABLE microscope DROP FOREIGN KEY FK_2DEFA95273484933');
        $this->addSql('ALTER TABLE microscope DROP FOREIGN KEY FK_2DEFA952B47685CD');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418DE13F470');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418DD5AFB87');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B784184609C78A');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B784181F8ACB26');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B7841886AD25F8');
        $this->addSql('ALTER TABLE sample DROP FOREIGN KEY FK_F10B76C3F6BD1646');
        $this->addSql('ALTER TABLE site DROP FOREIGN KEY FK_694309E4F091D9C7');
        $this->addSql('ALTER TABLE site DROP FOREIGN KEY FK_694309E4F639F774');
        $this->addSql('ALTER TABLE slide DROP FOREIGN KEY FK_72EFEE621B1FEA20');
        $this->addSql('DROP TABLE camera');
        $this->addSql('DROP TABLE campaign');
        $this->addSql('DROP TABLE geography');
        $this->addSql('DROP TABLE microscope');
        $this->addSql('DROP TABLE model');
        $this->addSql('DROP TABLE objective');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE producer');
        $this->addSql('DROP TABLE relative_age');
        $this->addSql('DROP TABLE sample');
        $this->addSql('DROP TABLE site');
        $this->addSql('DROP TABLE slide');
        $this->addSql('DROP TABLE taxon');
        $this->addSql('DROP TABLE technique');
    }
}
