<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200705112300 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE celebrity DROP FOREIGN KEY FK_88B7697FDEF8996');
        $this->addSql('DROP INDEX IDX_88B7697FDEF8996 ON celebrity');
        $this->addSql('ALTER TABLE celebrity ADD profession LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', DROP profession_id, CHANGE cemetery_id cemetery_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cemetery CHANGE city_id city_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE celebrity ADD profession_id INT DEFAULT NULL, DROP profession, CHANGE cemetery_id cemetery_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE celebrity ADD CONSTRAINT FK_88B7697FDEF8996 FOREIGN KEY (profession_id) REFERENCES profession (id)');
        $this->addSql('CREATE INDEX IDX_88B7697FDEF8996 ON celebrity (profession_id)');
        $this->addSql('ALTER TABLE cemetery CHANGE city_id city_id INT DEFAULT NULL');
    }
}
