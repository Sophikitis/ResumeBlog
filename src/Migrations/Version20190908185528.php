<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190908185528 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE formations (id INT AUTO_INCREMENT NOT NULL, resume_me_id INT DEFAULT NULL, title VARCHAR(100) NOT NULL, description LONGTEXT DEFAULT NULL, start_at DATETIME DEFAULT NULL, end_at DATETIME DEFAULT NULL, organisation VARCHAR(150) DEFAULT NULL, city VARCHAR(100) DEFAULT NULL, INDEX IDX_40902137AE8F9F9A (resume_me_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE formations ADD CONSTRAINT FK_40902137AE8F9F9A FOREIGN KEY (resume_me_id) REFERENCES resume_me (id)');
        $this->addSql('ALTER TABLE works ADD city VARCHAR(100) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE formations');
        $this->addSql('ALTER TABLE works DROP city');
    }
}
