<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230109122926 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455F6BD1646');
        $this->addSql('DROP INDEX IDX_C7440455F6BD1646 ON client');
        $this->addSql('ALTER TABLE client DROP site_id');
        $this->addSql('ALTER TABLE modele DROP FOREIGN KEY FK_10028558F6BD1646');
        $this->addSql('DROP INDEX IDX_10028558F6BD1646 ON modele');
        $this->addSql('ALTER TABLE modele DROP site_id');
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB6203DA5256D');
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB620EA6DF1F1');
        $this->addSql('DROP INDEX IDX_140AB620EA6DF1F1 ON page');
        $this->addSql('DROP INDEX IDX_140AB6203DA5256D ON page');
        $this->addSql('ALTER TABLE page DROP image_id, DROP texte_id');
        $this->addSql('ALTER TABLE site DROP FOREIGN KEY FK_694309E4C4663E4');
        $this->addSql('DROP INDEX IDX_694309E4C4663E4 ON site');
        $this->addSql('ALTER TABLE site DROP page_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client ADD site_id INT NOT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id)');
        $this->addSql('CREATE INDEX IDX_C7440455F6BD1646 ON client (site_id)');
        $this->addSql('ALTER TABLE page ADD image_id INT NOT NULL, ADD texte_id INT NOT NULL');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB6203DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB620EA6DF1F1 FOREIGN KEY (texte_id) REFERENCES texte (id)');
        $this->addSql('CREATE INDEX IDX_140AB620EA6DF1F1 ON page (texte_id)');
        $this->addSql('CREATE INDEX IDX_140AB6203DA5256D ON page (image_id)');
        $this->addSql('ALTER TABLE modele ADD site_id INT NOT NULL');
        $this->addSql('ALTER TABLE modele ADD CONSTRAINT FK_10028558F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id)');
        $this->addSql('CREATE INDEX IDX_10028558F6BD1646 ON modele (site_id)');
        $this->addSql('ALTER TABLE site ADD page_id INT NOT NULL');
        $this->addSql('ALTER TABLE site ADD CONSTRAINT FK_694309E4C4663E4 FOREIGN KEY (page_id) REFERENCES page (id)');
        $this->addSql('CREATE INDEX IDX_694309E4C4663E4 ON site (page_id)');
    }
}
