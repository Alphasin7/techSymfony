<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231224144741 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74B2415B55D');
        $this->addSql('DROP INDEX IDX_3170B74B2415B55D ON ligne_commande');
        $this->addSql('ALTER TABLE ligne_commande DROP ligne_commande_commande_id, CHANGE commande_id commande_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ligne_commande ADD ligne_commande_commande_id INT NOT NULL, CHANGE commande_id commande_id INT NOT NULL');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74B2415B55D FOREIGN KEY (ligne_commande_commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_3170B74B2415B55D ON ligne_commande (ligne_commande_commande_id)');
    }
}
