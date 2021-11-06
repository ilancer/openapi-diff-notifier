<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211106112158 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Recipient list';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recipient (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, chat_id VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6804FB491A9A7125 ON recipient (chat_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__open_api_url AS SELECT id, url, title FROM open_api_url');
        $this->addSql('DROP TABLE open_api_url');
        $this->addSql('CREATE TABLE open_api_url (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, url CLOB NOT NULL COLLATE BINARY, title VARCHAR(255) NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO open_api_url (id, url, title) SELECT id, url, title FROM __temp__open_api_url');
        $this->addSql('DROP TABLE __temp__open_api_url');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DAC0CF69F47645AE ON open_api_url (url)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE recipient');
        $this->addSql('DROP INDEX UNIQ_DAC0CF69F47645AE');
        $this->addSql('CREATE TEMPORARY TABLE __temp__open_api_url AS SELECT id, url, title FROM open_api_url');
        $this->addSql('DROP TABLE open_api_url');
        $this->addSql('CREATE TABLE open_api_url (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, url CLOB NOT NULL, title VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO open_api_url (id, url, title) SELECT id, url, title FROM __temp__open_api_url');
        $this->addSql('DROP TABLE __temp__open_api_url');
    }
}
