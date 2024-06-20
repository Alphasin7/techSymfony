<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231224150130 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consommable ADD ligne_commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE consommable ADD CONSTRAINT FK_A04C7F4DE10FEE63 FOREIGN KEY (ligne_commande_id) REFERENCES ligne_commande (id)');
        $this->addSql('CREATE INDEX IDX_A04C7F4DE10FEE63 ON consommable (ligne_commande_id)');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74B79A834F4');
        $this->addSql('DROP INDEX IDX_3170B74B79A834F4 ON ligne_commande');
        $this->addSql('ALTER TABLE ligne_commande DROP ligne_commande_consommable_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consommable DROP FOREIGN KEY FK_A04C7F4DE10FEE63');
        $this->addSql('DROP INDEX IDX_A04C7F4DE10FEE63 ON consommable');
        $this->addSql('ALTER TABLE consommable DROP ligne_commande_id');
        $this->addSql('ALTER TABLE ligne_commande ADD ligne_commande_consommable_id INT NOT NULL');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74B79A834F4 FOREIGN KEY (ligne_commande_consommable_id) REFERENCES consommable (id)');
        $this->addSql('CREATE INDEX IDX_3170B74B79A834F4 ON ligne_commande (ligne_commande_consommable_id)');
    }
}
