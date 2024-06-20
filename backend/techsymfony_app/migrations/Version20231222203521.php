<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231222203521 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipement DROP FOREIGN KEY FK_B8B4C6F3ACE39946');
        $this->addSql('DROP INDEX IDX_B8B4C6F3ACE39946 ON equipement');
        $this->addSql('ALTER TABLE equipement DROP equipement_user_id, CHANGE user_id user_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipement ADD equipement_user_id INT NOT NULL, CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE equipement ADD CONSTRAINT FK_B8B4C6F3ACE39946 FOREIGN KEY (equipement_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_B8B4C6F3ACE39946 ON equipement (equipement_user_id)');
    }
}
