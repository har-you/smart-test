<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200704113815 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE celebrity (id INT AUTO_INCREMENT NOT NULL, profession_id INT DEFAULT NULL, cemetery_id INT DEFAULT NULL, nick_name VARCHAR(50) NOT NULL, last_first_name VARCHAR(50) NOT NULL, nationality LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', death_date DATETIME NOT NULL, INDEX IDX_88B7697FDEF8996 (profession_id), INDEX IDX_88B7697EC636C87 (cemetery_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cemetery (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, address VARCHAR(50) NOT NULL, gps_coordinates VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profession (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE celebrity ADD CONSTRAINT FK_88B7697FDEF8996 FOREIGN KEY (profession_id) REFERENCES profession (id)');
        $this->addSql('ALTER TABLE celebrity ADD CONSTRAINT FK_88B7697EC636C87 FOREIGN KEY (cemetery_id) REFERENCES cemetery (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE celebrity DROP FOREIGN KEY FK_88B7697EC636C87');
        $this->addSql('ALTER TABLE celebrity DROP FOREIGN KEY FK_88B7697FDEF8996');
        $this->addSql('DROP TABLE celebrity');
        $this->addSql('DROP TABLE cemetery');
        $this->addSql('DROP TABLE profession');
    }
}
