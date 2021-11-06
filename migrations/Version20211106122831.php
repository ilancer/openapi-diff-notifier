<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211106122831 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE open_api_url (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_DAC0CF69F47645AE (url), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE open_api_url_recipient (open_api_url_id INT NOT NULL, recipient_id INT NOT NULL, INDEX IDX_1A01A24BF6413C74 (open_api_url_id), INDEX IDX_1A01A24BE92F8F78 (recipient_id), PRIMARY KEY(open_api_url_id, recipient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipient (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, chat_id VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_6804FB491A9A7125 (chat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE open_api_url_recipient ADD CONSTRAINT FK_1A01A24BF6413C74 FOREIGN KEY (open_api_url_id) REFERENCES open_api_url (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE open_api_url_recipient ADD CONSTRAINT FK_1A01A24BE92F8F78 FOREIGN KEY (recipient_id) REFERENCES recipient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE history ADD CONSTRAINT FK_27BA704BBDBE212D FOREIGN KEY (open_api_id) REFERENCES open_api_url (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE history DROP FOREIGN KEY FK_27BA704BBDBE212D');
        $this->addSql('ALTER TABLE open_api_url_recipient DROP FOREIGN KEY FK_1A01A24BF6413C74');
        $this->addSql('ALTER TABLE open_api_url_recipient DROP FOREIGN KEY FK_1A01A24BE92F8F78');
        $this->addSql('DROP TABLE open_api_url');
        $this->addSql('DROP TABLE open_api_url_recipient');
        $this->addSql('DROP TABLE recipient');
    }
}
