<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231018164434 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE person (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, birth_date DATE DEFAULT NULL, uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_34DCD176D17F50A6 (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, person_id INT DEFAULT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, token VARCHAR(255) DEFAULT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649D17F50A6 (uuid), INDEX IDX_8D93D649217BBB47 (person_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wishlist (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, string VARCHAR(255) NOT NULL, uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_9CE12A31D17F50A6 (uuid), INDEX IDX_9CE12A317E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wishlist_group (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, string VARCHAR(255) NOT NULL, uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_39652C3DD17F50A6 (uuid), INDEX IDX_39652C3D7E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wishlist_group_member (id INT AUTO_INCREMENT NOT NULL, wishlist_group_id INT DEFAULT NULL, wishlist_member_id INT DEFAULT NULL, pseudonym VARCHAR(255) DEFAULT NULL, uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_ECFC5332D17F50A6 (uuid), INDEX IDX_ECFC53324E1B4DB3 (wishlist_group_id), INDEX IDX_ECFC5332CFF7AA6F (wishlist_member_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wishlist_member (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, register TINYINT(1) NOT NULL, uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_C3D6253ED17F50A6 (uuid), INDEX IDX_C3D6253EA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE wishlist ADD CONSTRAINT FK_9CE12A317E3C61F9 FOREIGN KEY (owner_id) REFERENCES wishlist_member (id)');
        $this->addSql('ALTER TABLE wishlist_group ADD CONSTRAINT FK_39652C3D7E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE wishlist_group_member ADD CONSTRAINT FK_ECFC53324E1B4DB3 FOREIGN KEY (wishlist_group_id) REFERENCES wishlist_group (id)');
        $this->addSql('ALTER TABLE wishlist_group_member ADD CONSTRAINT FK_ECFC5332CFF7AA6F FOREIGN KEY (wishlist_member_id) REFERENCES wishlist_member (id)');
        $this->addSql('ALTER TABLE wishlist_member ADD CONSTRAINT FK_C3D6253EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649217BBB47');
        $this->addSql('ALTER TABLE wishlist DROP FOREIGN KEY FK_9CE12A317E3C61F9');
        $this->addSql('ALTER TABLE wishlist_group DROP FOREIGN KEY FK_39652C3D7E3C61F9');
        $this->addSql('ALTER TABLE wishlist_group_member DROP FOREIGN KEY FK_ECFC53324E1B4DB3');
        $this->addSql('ALTER TABLE wishlist_group_member DROP FOREIGN KEY FK_ECFC5332CFF7AA6F');
        $this->addSql('ALTER TABLE wishlist_member DROP FOREIGN KEY FK_C3D6253EA76ED395');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE wishlist');
        $this->addSql('DROP TABLE wishlist_group');
        $this->addSql('DROP TABLE wishlist_group_member');
        $this->addSql('DROP TABLE wishlist_member');
    }
}
