<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230109123747 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image ADD section_id INT NOT NULL, ADD page_id INT NOT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FD823E37A FOREIGN KEY (section_id) REFERENCES section (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FC4663E4 FOREIGN KEY (page_id) REFERENCES page (id)');
        $this->addSql('CREATE INDEX IDX_C53D045FD823E37A ON image (section_id)');
        $this->addSql('CREATE INDEX IDX_C53D045FC4663E4 ON image (page_id)');
        $this->addSql('ALTER TABLE page ADD site_id INT NOT NULL');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB620F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id)');
        $this->addSql('CREATE INDEX IDX_140AB620F6BD1646 ON page (site_id)');
        $this->addSql('ALTER TABLE site ADD modele_id INT NOT NULL');
        $this->addSql('ALTER TABLE site ADD CONSTRAINT FK_694309E4AC14B70A FOREIGN KEY (modele_id) REFERENCES modele (id)');
        $this->addSql('CREATE INDEX IDX_694309E4AC14B70A ON site (modele_id)');
        $this->addSql('ALTER TABLE texte ADD section_id INT NOT NULL, ADD page_id INT NOT NULL');
        $this->addSql('ALTER TABLE texte ADD CONSTRAINT FK_EAE1A6EED823E37A FOREIGN KEY (section_id) REFERENCES section (id)');
        $this->addSql('ALTER TABLE texte ADD CONSTRAINT FK_EAE1A6EEC4663E4 FOREIGN KEY (page_id) REFERENCES page (id)');
        $this->addSql('CREATE INDEX IDX_EAE1A6EED823E37A ON texte (section_id)');
        $this->addSql('CREATE INDEX IDX_EAE1A6EEC4663E4 ON texte (page_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE texte DROP FOREIGN KEY FK_EAE1A6EED823E37A');
        $this->addSql('ALTER TABLE texte DROP FOREIGN KEY FK_EAE1A6EEC4663E4');
        $this->addSql('DROP INDEX IDX_EAE1A6EED823E37A ON texte');
        $this->addSql('DROP INDEX IDX_EAE1A6EEC4663E4 ON texte');
        $this->addSql('ALTER TABLE texte DROP section_id, DROP page_id');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FD823E37A');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FC4663E4');
        $this->addSql('DROP INDEX IDX_C53D045FD823E37A ON image');
        $this->addSql('DROP INDEX IDX_C53D045FC4663E4 ON image');
        $this->addSql('ALTER TABLE image DROP section_id, DROP page_id');
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB620F6BD1646');
        $this->addSql('DROP INDEX IDX_140AB620F6BD1646 ON page');
        $this->addSql('ALTER TABLE page DROP site_id');
        $this->addSql('ALTER TABLE site DROP FOREIGN KEY FK_694309E4AC14B70A');
        $this->addSql('DROP INDEX IDX_694309E4AC14B70A ON site');
        $this->addSql('ALTER TABLE site DROP modele_id');
    }
}
