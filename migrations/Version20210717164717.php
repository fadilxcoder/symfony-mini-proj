<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210717164717 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE newsletter (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(100) NOT NULL, logged DATETIME NOT NULL, UNIQUE INDEX UNIQ_7E8585C8E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partners (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, position INT NOT NULL, status TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pricing_block (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, price INT DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, position INT NOT NULL, status TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE testimonials (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, status TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, token VARCHAR(255) DEFAULT NULL, is_rgpd_accepted TINYINT(1) DEFAULT NULL, rgpd_accepted_at DATETIME DEFAULT NULL, last_login_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicules (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, gear_box VARCHAR(255) NOT NULL, price_per_day VARCHAR(255) NOT NULL, year VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, additional_details LONGTEXT NOT NULL, is_displayed TINYINT(1) DEFAULT NULL, fuel VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_78218C2D12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicules_stats (id INT AUTO_INCREMENT NOT NULL, vehicules_id INT NOT NULL, user_id INT DEFAULT NULL, INDEX IDX_503731FE8D8BD7E2 (vehicules_id), INDEX IDX_503731FEA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vehicules ADD CONSTRAINT FK_78218C2D12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE vehicules_stats ADD CONSTRAINT FK_503731FE8D8BD7E2 FOREIGN KEY (vehicules_id) REFERENCES vehicules (id)');
        $this->addSql('ALTER TABLE vehicules_stats ADD CONSTRAINT FK_503731FEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicules DROP FOREIGN KEY FK_78218C2D12469DE2');
        $this->addSql('ALTER TABLE vehicules_stats DROP FOREIGN KEY FK_503731FEA76ED395');
        $this->addSql('ALTER TABLE vehicules_stats DROP FOREIGN KEY FK_503731FE8D8BD7E2');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE newsletter');
        $this->addSql('DROP TABLE partners');
        $this->addSql('DROP TABLE pricing_block');
        $this->addSql('DROP TABLE testimonials');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vehicules');
        $this->addSql('DROP TABLE vehicules_stats');
    }
}
