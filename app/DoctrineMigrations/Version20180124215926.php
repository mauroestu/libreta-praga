<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180124215926 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_2265B05DF85E0677 ON usuario');
        $this->addSql('DROP INDEX UNIQ_2265B05D77040BC9 ON usuario');
        $this->addSql('ALTER TABLE usuario ADD username_canonical VARCHAR(180) NOT NULL, ADD email VARCHAR(180) NOT NULL, ADD email_canonical VARCHAR(180) NOT NULL, ADD enabled TINYINT(1) NOT NULL, ADD salt VARCHAR(255) DEFAULT NULL, ADD last_login DATETIME DEFAULT NULL, ADD confirmation_token VARCHAR(180) DEFAULT NULL, ADD password_requested_at DATETIME DEFAULT NULL, ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', DROP contrasenia, CHANGE username username VARCHAR(180) NOT NULL, CHANGE correo password VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2265B05D92FC23A8 ON usuario (username_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2265B05DA0D96FBF ON usuario (email_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2265B05DC05FB297 ON usuario (confirmation_token)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_2265B05D92FC23A8 ON usuario');
        $this->addSql('DROP INDEX UNIQ_2265B05DA0D96FBF ON usuario');
        $this->addSql('DROP INDEX UNIQ_2265B05DC05FB297 ON usuario');
        $this->addSql('ALTER TABLE usuario ADD contrasenia VARCHAR(64) NOT NULL COLLATE utf8_unicode_ci, DROP username_canonical, DROP email, DROP email_canonical, DROP enabled, DROP salt, DROP last_login, DROP confirmation_token, DROP password_requested_at, DROP roles, CHANGE username username VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE password correo VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2265B05DF85E0677 ON usuario (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2265B05D77040BC9 ON usuario (correo)');
    }
}
