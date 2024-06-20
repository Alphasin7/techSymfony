<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231126095711 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_consommable DROP FOREIGN KEY FK_E9BDFA2C82EA2E54');
        $this->addSql('ALTER TABLE commande_consommable DROP FOREIGN KEY FK_E9BDFA2CC9CEB381');
        $this->addSql('DROP TABLE commande_consommable');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande_consommable (commande_id INT NOT NULL, consommable_id INT NOT NULL, INDEX IDX_E9BDFA2C82EA2E54 (commande_id), INDEX IDX_E9BDFA2CC9CEB381 (consommable_id), PRIMARY KEY(commande_id, consommable_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE commande_consommable ADD CONSTRAINT FK_E9BDFA2C82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_consommable ADD CONSTRAINT FK_E9BDFA2CC9CEB381 FOREIGN KEY (consommable_id) REFERENCES consommable (id) ON DELETE CASCADE');
    }
}
