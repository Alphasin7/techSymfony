<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231224143951 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D51D5A135');
        $this->addSql('DROP INDEX IDX_6EEAA67D51D5A135 ON commande');
        $this->addSql('ALTER TABLE commande DROP commande_user_id, CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE conge DROP FOREIGN KEY FK_2ED8934877E28836');
        $this->addSql('DROP INDEX IDX_2ED8934877E28836 ON conge');
        $this->addSql('ALTER TABLE conge DROP conge_user_id');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE60640476440D04');
        $this->addSql('DROP INDEX IDX_CE60640476440D04 ON reclamation');
        $this->addSql('ALTER TABLE reclamation DROP reclamation_user_id, CHANGE user_id user_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande ADD commande_user_id INT NOT NULL, CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D51D5A135 FOREIGN KEY (commande_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D51D5A135 ON commande (commande_user_id)');
        $this->addSql('ALTER TABLE conge ADD conge_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE conge ADD CONSTRAINT FK_2ED8934877E28836 FOREIGN KEY (conge_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_2ED8934877E28836 ON conge (conge_user_id)');
        $this->addSql('ALTER TABLE reclamation ADD reclamation_user_id INT DEFAULT NULL, CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE60640476440D04 FOREIGN KEY (reclamation_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_CE60640476440D04 ON reclamation (reclamation_user_id)');
    }
}
