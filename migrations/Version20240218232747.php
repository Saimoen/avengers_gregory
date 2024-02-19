<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240218232747 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mot_cles_marque_page DROP FOREIGN KEY FK_D48592B3855234A9');
        $this->addSql('ALTER TABLE mot_cles_marque_page DROP FOREIGN KEY FK_D48592B3D59CC0F1');
        $this->addSql('DROP TABLE mot_cles_marque_page');
        $this->addSql('ALTER TABLE marque_page DROP FOREIGN KEY FK_19292F83855234A9');
        $this->addSql('DROP INDEX IDX_19292F83855234A9 ON marque_page');
        $this->addSql('ALTER TABLE marque_page DROP mot_cles_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mot_cles_marque_page (mot_cles_id INT NOT NULL, marque_page_id INT NOT NULL, INDEX IDX_D48592B3855234A9 (mot_cles_id), INDEX IDX_D48592B3D59CC0F1 (marque_page_id), PRIMARY KEY(mot_cles_id, marque_page_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE mot_cles_marque_page ADD CONSTRAINT FK_D48592B3855234A9 FOREIGN KEY (mot_cles_id) REFERENCES mot_cles (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mot_cles_marque_page ADD CONSTRAINT FK_D48592B3D59CC0F1 FOREIGN KEY (marque_page_id) REFERENCES marque_page (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE marque_page ADD mot_cles_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE marque_page ADD CONSTRAINT FK_19292F83855234A9 FOREIGN KEY (mot_cles_id) REFERENCES mot_cles (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_19292F83855234A9 ON marque_page (mot_cles_id)');
    }
}
