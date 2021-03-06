<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190923041747 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE accounts (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(200) NOT NULL, birthday_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE addresses (id INT AUTO_INCREMENT NOT NULL, street_name VARCHAR(200) NOT NULL, neightborhood VARCHAR(150) NOT NULL, zip_code VARCHAR(10) NOT NULL, district VARCHAR(200) NOT NULL, country VARCHAR(200) NOT NULL, number VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE addresses_accounts (addresses_id INT NOT NULL, accounts_id INT NOT NULL, INDEX IDX_4EAD02895713BC80 (addresses_id), INDEX IDX_4EAD0289CC5E8CE8 (accounts_id), PRIMARY KEY(addresses_id, accounts_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, account_id_id INT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D64949CB4726 (account_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE addresses_accounts ADD CONSTRAINT FK_4EAD02895713BC80 FOREIGN KEY (addresses_id) REFERENCES addresses (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE addresses_accounts ADD CONSTRAINT FK_4EAD0289CC5E8CE8 FOREIGN KEY (accounts_id) REFERENCES accounts (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64949CB4726 FOREIGN KEY (account_id_id) REFERENCES accounts (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE addresses_accounts DROP FOREIGN KEY FK_4EAD0289CC5E8CE8');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64949CB4726');
        $this->addSql('ALTER TABLE addresses_accounts DROP FOREIGN KEY FK_4EAD02895713BC80');
        $this->addSql('DROP TABLE accounts');
        $this->addSql('DROP TABLE addresses');
        $this->addSql('DROP TABLE addresses_accounts');
        $this->addSql('DROP TABLE user');
    }
}
