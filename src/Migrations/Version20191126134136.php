<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191126134136 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE UNIQUE INDEX UNIQ_64C19C15E237E06 ON category (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_665648E95E237E06 ON color (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D34A04AD5E237E06 ON product (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F7C0246A5E237E06 ON size (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1C52F9585E237E06 ON brand (name)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_1C52F9585E237E06 ON brand');
        $this->addSql('DROP INDEX UNIQ_64C19C15E237E06 ON category');
        $this->addSql('DROP INDEX UNIQ_665648E95E237E06 ON color');
        $this->addSql('DROP INDEX UNIQ_D34A04AD5E237E06 ON product');
        $this->addSql('DROP INDEX UNIQ_F7C0246A5E237E06 ON size');
    }
}
