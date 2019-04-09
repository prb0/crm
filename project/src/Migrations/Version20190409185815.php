<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190409185815 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE contact_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE deal_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE department_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE manager_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE stage_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE task_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE contact (id INT NOT NULL, name VARCHAR(127) DEFAULT NULL, phone VARCHAR(63) DEFAULT NULL, email VARCHAR(127) DEFAULT NULL, secondary_phone VARCHAR(63) DEFAULT NULL, city VARCHAR(127) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE deal (id INT NOT NULL, stage_id INT NOT NULL, manager_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, roistat VARCHAR(255) DEFAULT NULL, utm_source VARCHAR(255) DEFAULT NULL, utm_term VARCHAR(255) DEFAULT NULL, utm_content VARCHAR(255) DEFAULT NULL, utm_campaign VARCHAR(255) DEFAULT NULL, utm_medium VARCHAR(255) DEFAULT NULL, source VARCHAR(255) DEFAULT NULL, request_type VARCHAR(255) DEFAULT NULL, referrer VARCHAR(255) DEFAULT NULL, refpage VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E3FEC1162298D193 ON deal (stage_id)');
        $this->addSql('CREATE INDEX IDX_E3FEC116783E3463 ON deal (manager_id)');
        $this->addSql('CREATE TABLE department (id INT NOT NULL, code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, permissions INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE manager (id INT NOT NULL, department_id INT NOT NULL, name VARCHAR(127) NOT NULL, phone VARCHAR(63) DEFAULT NULL, secondary_phone VARCHAR(63) DEFAULT NULL, email VARCHAR(127) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, registered INT NOT NULL, birthdate INT DEFAULT NULL, gender BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FA2425B9AE80F5DF ON manager (department_id)');
        $this->addSql('CREATE TABLE stage (id INT NOT NULL, code VARCHAR(127) NOT NULL, name VARCHAR(127) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE task (id INT NOT NULL, manager_id INT NOT NULL, deal_id INT DEFAULT NULL, contact_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, deadline INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_527EDB25783E3463 ON task (manager_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_527EDB25F60E2305 ON task (deal_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_527EDB25E7A1254A ON task (contact_id)');
        $this->addSql('ALTER TABLE deal ADD CONSTRAINT FK_E3FEC1162298D193 FOREIGN KEY (stage_id) REFERENCES stage (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE deal ADD CONSTRAINT FK_E3FEC116783E3463 FOREIGN KEY (manager_id) REFERENCES manager (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE manager ADD CONSTRAINT FK_FA2425B9AE80F5DF FOREIGN KEY (department_id) REFERENCES department (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25783E3463 FOREIGN KEY (manager_id) REFERENCES manager (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25F60E2305 FOREIGN KEY (deal_id) REFERENCES deal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE task DROP CONSTRAINT FK_527EDB25E7A1254A');
        $this->addSql('ALTER TABLE task DROP CONSTRAINT FK_527EDB25F60E2305');
        $this->addSql('ALTER TABLE manager DROP CONSTRAINT FK_FA2425B9AE80F5DF');
        $this->addSql('ALTER TABLE deal DROP CONSTRAINT FK_E3FEC116783E3463');
        $this->addSql('ALTER TABLE task DROP CONSTRAINT FK_527EDB25783E3463');
        $this->addSql('ALTER TABLE deal DROP CONSTRAINT FK_E3FEC1162298D193');
        $this->addSql('DROP SEQUENCE contact_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE deal_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE department_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE manager_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE stage_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE task_id_seq CASCADE');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE deal');
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE manager');
        $this->addSql('DROP TABLE stage');
        $this->addSql('DROP TABLE task');
    }
}
