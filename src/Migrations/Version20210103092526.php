<?php

declare(strict_types=1);

namespace dir_name;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210103092526 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE vehicules (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, gear_box VARCHAR(255) NOT NULL, price_per_day VARCHAR(255) NOT NULL, year VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, additional_details VARCHAR(255) NOT NULL, is_displayed TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE vehicules');
    }
}
