<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230610212926 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE program ADD journey_of_reservation DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', DROP started_at, DROP ended_at');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE program ADD ended_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE journey_of_reservation started_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }
}
