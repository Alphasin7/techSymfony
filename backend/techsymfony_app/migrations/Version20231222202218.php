<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231222202218 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5ECC57A8CEA');
        $this->addSql('DROP INDEX UNIQ_EDBFD5ECC57A8CEA ON historique');
        $this->addSql('ALTER TABLE historique ADD user_id_id INT DEFAULT NULL, DROP historique_user_id');
        $this->addSql('ALTER TABLE historique ADD CONSTRAINT FK_EDBFD5EC9D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_EDBFD5EC9D86650F ON historique (user_id_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6498FA6DE0E');
        $this->addSql('DROP INDEX UNIQ_8D93D6498FA6DE0E ON user');
        $this->addSql('ALTER TABLE user DROP user_historique_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5EC9D86650F');
        $this->addSql('DROP INDEX IDX_EDBFD5EC9D86650F ON historique');
        $this->addSql('ALTER TABLE historique ADD historique_user_id INT NOT NULL, DROP user_id_id');
        $this->addSql('ALTER TABLE historique ADD CONSTRAINT FK_EDBFD5ECC57A8CEA FOREIGN KEY (historique_user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EDBFD5ECC57A8CEA ON historique (historique_user_id)');
        $this->addSql('ALTER TABLE `user` ADD user_historique_id INT NOT NULL');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D6498FA6DE0E FOREIGN KEY (user_historique_id) REFERENCES historique (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6498FA6DE0E ON `user` (user_historique_id)');
    }
}
