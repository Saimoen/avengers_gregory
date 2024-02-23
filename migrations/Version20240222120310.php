<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240222120310 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE faune_image DROP FOREIGN KEY FK_B5DF9CE83DA5256D');
        $this->addSql('ALTER TABLE faune_image DROP FOREIGN KEY FK_B5DF9CE8B6727F49');
        $this->addSql('ALTER TABLE flore_image DROP FOREIGN KEY FK_52DBFBD33DA5256D');
        $this->addSql('ALTER TABLE flore_image DROP FOREIGN KEY FK_52DBFBD3D0F845F7');
        $this->addSql('DROP TABLE faune_image');
        $this->addSql('DROP TABLE flore_image');
        $this->addSql('DROP TABLE image');
        $this->addSql('ALTER TABLE faune ADD image VARCHAR(255) NOT NULL, ADD description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE flore ADD image VARCHAR(255) NOT NULL, ADD description VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE faune_image (faune_id INT NOT NULL, image_id INT NOT NULL, INDEX IDX_B5DF9CE8B6727F49 (faune_id), INDEX IDX_B5DF9CE83DA5256D (image_id), PRIMARY KEY(faune_id, image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE flore_image (flore_id INT NOT NULL, image_id INT NOT NULL, INDEX IDX_52DBFBD3D0F845F7 (flore_id), INDEX IDX_52DBFBD33DA5256D (image_id), PRIMARY KEY(flore_id, image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, alt VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE faune_image ADD CONSTRAINT FK_B5DF9CE83DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE faune_image ADD CONSTRAINT FK_B5DF9CE8B6727F49 FOREIGN KEY (faune_id) REFERENCES faune (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE flore_image ADD CONSTRAINT FK_52DBFBD33DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE flore_image ADD CONSTRAINT FK_52DBFBD3D0F845F7 FOREIGN KEY (flore_id) REFERENCES flore (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE faune DROP image, DROP description');
        $this->addSql('ALTER TABLE flore DROP image, DROP description');
    }
}
