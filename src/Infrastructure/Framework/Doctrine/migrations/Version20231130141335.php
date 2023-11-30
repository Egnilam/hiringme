<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231130141335 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE basket ADD wishlist_group_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE basket ADD CONSTRAINT FK_2246507B4E1B4DB3 FOREIGN KEY (wishlist_group_id) REFERENCES wishlist_group (id)');
        $this->addSql('CREATE INDEX IDX_2246507B4E1B4DB3 ON basket (wishlist_group_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE basket DROP FOREIGN KEY FK_2246507B4E1B4DB3');
        $this->addSql('DROP INDEX IDX_2246507B4E1B4DB3 ON basket');
        $this->addSql('ALTER TABLE basket DROP wishlist_group_id');
    }
}
