<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231024154043 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE wishlist_group DROP FOREIGN KEY FK_39652C3D7E3C61F9');
        $this->addSql('ALTER TABLE wishlist_group ADD CONSTRAINT FK_39652C3D7E3C61F9 FOREIGN KEY (owner_id) REFERENCES wishlist_member (id)');
        $this->addSql('ALTER TABLE wishlist_member DROP INDEX IDX_C3D6253EA76ED395, ADD UNIQUE INDEX UNIQ_C3D6253EA76ED395 (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE wishlist_group DROP FOREIGN KEY FK_39652C3D7E3C61F9');
        $this->addSql('ALTER TABLE wishlist_group ADD CONSTRAINT FK_39652C3D7E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE wishlist_member DROP INDEX UNIQ_C3D6253EA76ED395, ADD INDEX IDX_C3D6253EA76ED395 (user_id)');
    }
}
