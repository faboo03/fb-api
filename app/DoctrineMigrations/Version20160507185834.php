<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160507185834 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE licence MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX UNIQ_1DAAE64840BE3323 ON licence');
        $this->addSql('ALTER TABLE licence DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE licence DROP id');
        $this->addSql('ALTER TABLE licence ADD PRIMARY KEY (licence_number)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE licence DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE licence ADD id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1DAAE64840BE3323 ON licence (licence_number)');
        $this->addSql('ALTER TABLE licence ADD PRIMARY KEY (id)');
    }
}
