<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231123154839 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE basket (id INT AUTO_INCREMENT NOT NULL, wishlist_member_id INT NOT NULL, wishlist_item_id INT NOT NULL, visible_name TINYINT(1) NOT NULL, can_be_shared TINYINT(1) NOT NULL, uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_2246507BD17F50A6 (uuid), INDEX IDX_2246507BCFF7AA6F (wishlist_member_id), INDEX IDX_2246507B8D638424 (wishlist_item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE basket ADD CONSTRAINT FK_2246507BCFF7AA6F FOREIGN KEY (wishlist_member_id) REFERENCES wishlist_member (id)');
        $this->addSql('ALTER TABLE basket ADD CONSTRAINT FK_2246507B8D638424 FOREIGN KEY (wishlist_item_id) REFERENCES wishlist_item (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE basket DROP FOREIGN KEY FK_2246507BCFF7AA6F');
        $this->addSql('ALTER TABLE basket DROP FOREIGN KEY FK_2246507B8D638424');
        $this->addSql('DROP TABLE basket');
    }
}
