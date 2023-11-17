<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231108145520 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE wishlist_item (id INT AUTO_INCREMENT NOT NULL, wishlist_id INT DEFAULT NULL, label VARCHAR(255) NOT NULL, link LONGTEXT DEFAULT NULL, description VARCHAR(500) DEFAULT NULL, priority VARCHAR(255) DEFAULT NULL, price DOUBLE PRECISION DEFAULT NULL, uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_6424F4E8D17F50A6 (uuid), INDEX IDX_6424F4E8FB8E54CD (wishlist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE wishlist_item ADD CONSTRAINT FK_6424F4E8FB8E54CD FOREIGN KEY (wishlist_id) REFERENCES wishlist_member (id)');
        $this->addSql('ALTER TABLE wishlist CHANGE string name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE wishlist_group CHANGE string name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE wishlist_item DROP FOREIGN KEY FK_6424F4E8FB8E54CD');
        $this->addSql('DROP TABLE wishlist_item');
        $this->addSql('ALTER TABLE wishlist_group CHANGE name string VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE wishlist CHANGE name string VARCHAR(255) NOT NULL');
    }
}
