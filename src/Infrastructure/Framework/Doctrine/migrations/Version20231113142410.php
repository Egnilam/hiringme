<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231113142410 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE wishlist_group_member ADD wishlist_id INT DEFAULT NULL, CHANGE wishlist_group_id wishlist_group_id INT NOT NULL, CHANGE wishlist_member_id wishlist_member_id INT NOT NULL');
        $this->addSql('ALTER TABLE wishlist_group_member ADD CONSTRAINT FK_ECFC5332FB8E54CD FOREIGN KEY (wishlist_id) REFERENCES wishlist (id)');
        $this->addSql('CREATE INDEX IDX_ECFC5332FB8E54CD ON wishlist_group_member (wishlist_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE wishlist_group_member DROP FOREIGN KEY FK_ECFC5332FB8E54CD');
        $this->addSql('DROP INDEX IDX_ECFC5332FB8E54CD ON wishlist_group_member');
        $this->addSql('ALTER TABLE wishlist_group_member DROP wishlist_id, CHANGE wishlist_group_id wishlist_group_id INT DEFAULT NULL, CHANGE wishlist_member_id wishlist_member_id INT DEFAULT NULL');
    }
}
