<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211106114110 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE open_api_url_recipient (open_api_url_id INTEGER NOT NULL, recipient_id INTEGER NOT NULL, PRIMARY KEY(open_api_url_id, recipient_id))');
        $this->addSql('CREATE INDEX IDX_1A01A24BF6413C74 ON open_api_url_recipient (open_api_url_id)');
        $this->addSql('CREATE INDEX IDX_1A01A24BE92F8F78 ON open_api_url_recipient (recipient_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE open_api_url_recipient');
    }
}
