<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231126095427 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consommable_commande DROP FOREIGN KEY FK_80308A9282EA2E54');
        $this->addSql('ALTER TABLE consommable_commande DROP FOREIGN KEY FK_80308A92C9CEB381');
        $this->addSql('ALTER TABLE consommable_equipement DROP FOREIGN KEY FK_538AABE9C9CEB381');
        $this->addSql('ALTER TABLE consommable_equipement DROP FOREIGN KEY FK_538AABE9806F0F5C');
        $this->addSql('DROP TABLE consommable_commande');
        $this->addSql('DROP TABLE consommable_equipement');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE consommable_commande (consommable_id INT NOT NULL, commande_id INT NOT NULL, INDEX IDX_80308A9282EA2E54 (commande_id), INDEX IDX_80308A92C9CEB381 (consommable_id), PRIMARY KEY(consommable_id, commande_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE consommable_equipement (consommable_id INT NOT NULL, equipement_id INT NOT NULL, INDEX IDX_538AABE9806F0F5C (equipement_id), INDEX IDX_538AABE9C9CEB381 (consommable_id), PRIMARY KEY(consommable_id, equipement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE consommable_commande ADD CONSTRAINT FK_80308A9282EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE consommable_commande ADD CONSTRAINT FK_80308A92C9CEB381 FOREIGN KEY (consommable_id) REFERENCES consommable (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE consommable_equipement ADD CONSTRAINT FK_538AABE9C9CEB381 FOREIGN KEY (consommable_id) REFERENCES consommable (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE consommable_equipement ADD CONSTRAINT FK_538AABE9806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE');
    }
}
