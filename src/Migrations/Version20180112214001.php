<?php

declare(strict_types=1);

/*
 * This file is part of the JMT catalog package.
 *
 * (c) Connect Holland.
 */

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180112214001 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE bankaccount (id INT AUTO_INCREMENT NOT NULL, company VARCHAR(100) NOT NULL, account_number VARCHAR(100) NOT NULL, category VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mutation (id INT AUTO_INCREMENT NOT NULL, bankaccount_id INT DEFAULT NULL, amount INT NOT NULL, date DATETIME NOT NULL, INDEX IDX_4F4978F6A51AA83E (bankaccount_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mutation ADD CONSTRAINT FK_4F4978F6A51AA83E FOREIGN KEY (bankaccount_id) REFERENCES bankaccount (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE mutation DROP FOREIGN KEY FK_4F4978F6A51AA83E');
        $this->addSql('DROP TABLE bankaccount');
        $this->addSql('DROP TABLE mutation');
    }
}
