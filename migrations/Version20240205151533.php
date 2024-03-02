<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240205151533 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pdf ADD subs_pdf_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pdf ADD CONSTRAINT FK_EF0DB8C792D057C FOREIGN KEY (subs_pdf_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EF0DB8C792D057C ON pdf (subs_pdf_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pdf DROP FOREIGN KEY FK_EF0DB8C792D057C');
        $this->addSql('DROP INDEX UNIQ_EF0DB8C792D057C ON pdf');
        $this->addSql('ALTER TABLE pdf DROP subs_pdf_id');
    }
}
