<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240205151857 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pdf ADD sub_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pdf ADD CONSTRAINT FK_EF0DB8C56992D9 FOREIGN KEY (sub_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EF0DB8C56992D9 ON pdf (sub_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pdf DROP FOREIGN KEY FK_EF0DB8C56992D9');
        $this->addSql('DROP INDEX UNIQ_EF0DB8C56992D9 ON pdf');
        $this->addSql('ALTER TABLE pdf DROP sub_id');
    }
}
