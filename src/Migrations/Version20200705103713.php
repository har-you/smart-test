<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200705103713 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(50) NOT NULL, zip_code VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE celebrity CHANGE profession_id profession_id INT DEFAULT NULL, CHANGE cemetery_id cemetery_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cemetery ADD city_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cemetery ADD CONSTRAINT FK_99E113268BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('CREATE INDEX IDX_99E113268BAC62AF ON cemetery (city_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cemetery DROP FOREIGN KEY FK_99E113268BAC62AF');
        $this->addSql('DROP TABLE city');
        $this->addSql('ALTER TABLE celebrity CHANGE profession_id profession_id INT DEFAULT NULL, CHANGE cemetery_id cemetery_id INT DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_99E113268BAC62AF ON cemetery');
        $this->addSql('ALTER TABLE cemetery DROP city_id');
    }
}
