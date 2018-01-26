<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180126214922 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE mutation DROP FOREIGN KEY FK_4F4978F6A51AA83E');
        $this->addSql('CREATE TABLE mutation_account (id INT AUTO_INCREMENT NOT NULL, company VARCHAR(100) NOT NULL, category VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE bankaccount');
        $this->addSql('DROP INDEX IDX_4F4978F6A51AA83E ON mutation');
        $this->addSql('ALTER TABLE mutation CHANGE bankaccount_id mutation_account_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mutation ADD CONSTRAINT FK_4F4978F6FE44A29C FOREIGN KEY (mutation_account_id) REFERENCES mutation_account (id)');
        $this->addSql('CREATE INDEX IDX_4F4978F6FE44A29C ON mutation (mutation_account_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE mutation DROP FOREIGN KEY FK_4F4978F6FE44A29C');
        $this->addSql('CREATE TABLE bankaccount (id INT AUTO_INCREMENT NOT NULL, company VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci, account_number VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci, category VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE mutation_account');
        $this->addSql('DROP INDEX IDX_4F4978F6FE44A29C ON mutation');
        $this->addSql('ALTER TABLE mutation CHANGE mutation_account_id bankaccount_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mutation ADD CONSTRAINT FK_4F4978F6A51AA83E FOREIGN KEY (bankaccount_id) REFERENCES bankaccount (id)');
        $this->addSql('CREATE INDEX IDX_4F4978F6A51AA83E ON mutation (bankaccount_id)');
    }
}
