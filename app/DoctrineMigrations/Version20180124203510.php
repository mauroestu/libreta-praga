<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180124203510 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tipo (id INT NOT NULL, nombre VARCHAR(255) NOT NULL, activo TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, nombre_completo VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, correo VARCHAR(255) NOT NULL, contrasenia VARCHAR(64) NOT NULL, activo TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_2265B05DF85E0677 (username), UNIQUE INDEX UNIQ_2265B05D77040BC9 (correo), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nota (id INT AUTO_INCREMENT NOT NULL, libreta INT DEFAULT NULL, nota VARCHAR(100) NOT NULL, contenido VARCHAR(500) NOT NULL, activo TINYINT(1) NOT NULL, INDEX IDX_C8D03E0DE3BF0FB0 (libreta), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE libreta (id INT AUTO_INCREMENT NOT NULL, usuario INT DEFAULT NULL, tipo INT DEFAULT NULL, nombre VARCHAR(100) NOT NULL, descripcion VARCHAR(500) NOT NULL, activo TINYINT(1) NOT NULL, INDEX IDX_E3BF0FB02265B05D (usuario), INDEX IDX_E3BF0FB0702D1D47 (tipo), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE nota ADD CONSTRAINT FK_C8D03E0DE3BF0FB0 FOREIGN KEY (libreta) REFERENCES libreta (id)');
        $this->addSql('ALTER TABLE libreta ADD CONSTRAINT FK_E3BF0FB02265B05D FOREIGN KEY (usuario) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE libreta ADD CONSTRAINT FK_E3BF0FB0702D1D47 FOREIGN KEY (tipo) REFERENCES tipo (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE libreta DROP FOREIGN KEY FK_E3BF0FB0702D1D47');
        $this->addSql('ALTER TABLE libreta DROP FOREIGN KEY FK_E3BF0FB02265B05D');
        $this->addSql('ALTER TABLE nota DROP FOREIGN KEY FK_C8D03E0DE3BF0FB0');
        $this->addSql('DROP TABLE tipo');
        $this->addSql('DROP TABLE usuario');
        $this->addSql('DROP TABLE nota');
        $this->addSql('DROP TABLE libreta');
    }
}
