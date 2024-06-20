<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231126093214 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, commande_user_id INT NOT NULL, date DATE NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_6EEAA67DA76ED395 (user_id), INDEX IDX_6EEAA67D51D5A135 (commande_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_consommable (commande_id INT NOT NULL, consommable_id INT NOT NULL, INDEX IDX_E9BDFA2C82EA2E54 (commande_id), INDEX IDX_E9BDFA2CC9CEB381 (consommable_id), PRIMARY KEY(commande_id, consommable_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE conge (id INT AUTO_INCREMENT NOT NULL, conge_user_id INT DEFAULT NULL, user_id INT DEFAULT NULL, date_debut_con DATE NOT NULL, date_fin_con DATE NOT NULL, duree_conge INT NOT NULL, INDEX IDX_2ED8934877E28836 (conge_user_id), INDEX IDX_2ED89348A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE consommable (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, stock INT NOT NULL, image LONGBLOB NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE consommable_commande (consommable_id INT NOT NULL, commande_id INT NOT NULL, INDEX IDX_80308A92C9CEB381 (consommable_id), INDEX IDX_80308A9282EA2E54 (commande_id), PRIMARY KEY(consommable_id, commande_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE consommable_equipement (consommable_id INT NOT NULL, equipement_id INT NOT NULL, INDEX IDX_538AABE9C9CEB381 (consommable_id), INDEX IDX_538AABE9806F0F5C (equipement_id), PRIMARY KEY(consommable_id, equipement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipement (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, equipement_user_id INT NOT NULL, label VARCHAR(255) NOT NULL, image LONGBLOB NOT NULL, INDEX IDX_B8B4C6F3A76ED395 (user_id), INDEX IDX_B8B4C6F3ACE39946 (equipement_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipement_consommable (equipement_id INT NOT NULL, consommable_id INT NOT NULL, INDEX IDX_F05F5EA2806F0F5C (equipement_id), INDEX IDX_F05F5EA2C9CEB381 (consommable_id), PRIMARY KEY(equipement_id, consommable_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE historique (id INT AUTO_INCREMENT NOT NULL, historique_user_id INT NOT NULL, date_auth DATE NOT NULL, UNIQUE INDEX UNIQ_EDBFD5ECC57A8CEA (historique_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligne_commande (id INT AUTO_INCREMENT NOT NULL, commande_id INT NOT NULL, ligne_commande_commande_id INT NOT NULL, ligne_commande_consommable_id INT NOT NULL, quantite INT NOT NULL, INDEX IDX_3170B74B82EA2E54 (commande_id), INDEX IDX_3170B74B2415B55D (ligne_commande_commande_id), INDEX IDX_3170B74B79A834F4 (ligne_commande_consommable_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reclamation (id INT AUTO_INCREMENT NOT NULL, reclamation_user_id INT DEFAULT NULL, user_id INT NOT NULL, contenu VARCHAR(255) NOT NULL, date DATE NOT NULL, INDEX IDX_CE60640476440D04 (reclamation_user_id), INDEX IDX_CE606404A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, user_historique_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_nais DATE NOT NULL, adresse VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, nombre_jrs_conge INT NOT NULL, UNIQUE INDEX UNIQ_8D93D6498FA6DE0E (user_historique_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D51D5A135 FOREIGN KEY (commande_user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE commande_consommable ADD CONSTRAINT FK_E9BDFA2C82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_consommable ADD CONSTRAINT FK_E9BDFA2CC9CEB381 FOREIGN KEY (consommable_id) REFERENCES consommable (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE conge ADD CONSTRAINT FK_2ED8934877E28836 FOREIGN KEY (conge_user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE conge ADD CONSTRAINT FK_2ED89348A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE consommable_commande ADD CONSTRAINT FK_80308A92C9CEB381 FOREIGN KEY (consommable_id) REFERENCES consommable (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE consommable_commande ADD CONSTRAINT FK_80308A9282EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE consommable_equipement ADD CONSTRAINT FK_538AABE9C9CEB381 FOREIGN KEY (consommable_id) REFERENCES consommable (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE consommable_equipement ADD CONSTRAINT FK_538AABE9806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipement ADD CONSTRAINT FK_B8B4C6F3A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE equipement ADD CONSTRAINT FK_B8B4C6F3ACE39946 FOREIGN KEY (equipement_user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE equipement_consommable ADD CONSTRAINT FK_F05F5EA2806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipement_consommable ADD CONSTRAINT FK_F05F5EA2C9CEB381 FOREIGN KEY (consommable_id) REFERENCES consommable (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE historique ADD CONSTRAINT FK_EDBFD5ECC57A8CEA FOREIGN KEY (historique_user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74B82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74B2415B55D FOREIGN KEY (ligne_commande_commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74B79A834F4 FOREIGN KEY (ligne_commande_consommable_id) REFERENCES consommable (id)');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE60640476440D04 FOREIGN KEY (reclamation_user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE606404A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D6498FA6DE0E FOREIGN KEY (user_historique_id) REFERENCES historique (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DA76ED395');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D51D5A135');
        $this->addSql('ALTER TABLE commande_consommable DROP FOREIGN KEY FK_E9BDFA2C82EA2E54');
        $this->addSql('ALTER TABLE commande_consommable DROP FOREIGN KEY FK_E9BDFA2CC9CEB381');
        $this->addSql('ALTER TABLE conge DROP FOREIGN KEY FK_2ED8934877E28836');
        $this->addSql('ALTER TABLE conge DROP FOREIGN KEY FK_2ED89348A76ED395');
        $this->addSql('ALTER TABLE consommable_commande DROP FOREIGN KEY FK_80308A92C9CEB381');
        $this->addSql('ALTER TABLE consommable_commande DROP FOREIGN KEY FK_80308A9282EA2E54');
        $this->addSql('ALTER TABLE consommable_equipement DROP FOREIGN KEY FK_538AABE9C9CEB381');
        $this->addSql('ALTER TABLE consommable_equipement DROP FOREIGN KEY FK_538AABE9806F0F5C');
        $this->addSql('ALTER TABLE equipement DROP FOREIGN KEY FK_B8B4C6F3A76ED395');
        $this->addSql('ALTER TABLE equipement DROP FOREIGN KEY FK_B8B4C6F3ACE39946');
        $this->addSql('ALTER TABLE equipement_consommable DROP FOREIGN KEY FK_F05F5EA2806F0F5C');
        $this->addSql('ALTER TABLE equipement_consommable DROP FOREIGN KEY FK_F05F5EA2C9CEB381');
        $this->addSql('ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5ECC57A8CEA');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74B82EA2E54');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74B2415B55D');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74B79A834F4');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE60640476440D04');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE606404A76ED395');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6498FA6DE0E');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE commande_consommable');
        $this->addSql('DROP TABLE conge');
        $this->addSql('DROP TABLE consommable');
        $this->addSql('DROP TABLE consommable_commande');
        $this->addSql('DROP TABLE consommable_equipement');
        $this->addSql('DROP TABLE equipement');
        $this->addSql('DROP TABLE equipement_consommable');
        $this->addSql('DROP TABLE historique');
        $this->addSql('DROP TABLE ligne_commande');
        $this->addSql('DROP TABLE reclamation');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
