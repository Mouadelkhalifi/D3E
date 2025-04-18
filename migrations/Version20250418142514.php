<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250418142514 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE vtk_audit_log (id INT AUTO_INCREMENT NOT NULL, related_user_id INT DEFAULT NULL, action_type VARCHAR(50) NOT NULL, entity VARCHAR(100) NOT NULL, action_details LONGTEXT NOT NULL, timestamp DATE NOT NULL COMMENT '(DC2Type:date_immutable)', INDEX IDX_192B47B298771930 (related_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE vtk_contact (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, email VARCHAR(100) DEFAULT NULL, telephone VARCHAR(30) DEFAULT NULL, fonction VARCHAR(100) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_18CCBEB9395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE vtk_customer (id INT AUTO_INCREMENT NOT NULL, primary_contact_id INT DEFAULT NULL, company_name VARCHAR(255) NOT NULL, siret VARCHAR(20) DEFAULT NULL, address LONGTEXT DEFAULT NULL, city VARCHAR(100) DEFAULT NULL, postal_code VARCHAR(20) NOT NULL, country VARCHAR(100) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', UNIQUE INDEX UNIQ_9EAEE34AD905C92C (primary_contact_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE vtk_customer_ask (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, request_date DATE NOT NULL, pickup_address LONGTEXT DEFAULT NULL, pickup_date DATE DEFAULT NULL, status VARCHAR(50) DEFAULT NULL, notes LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_5D730A9E9395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE vtk_document (id INT AUTO_INCREMENT NOT NULL, ask_id INT DEFAULT NULL, lot_id INT DEFAULT NULL, customer_id INT DEFAULT NULL, uploaded_by_id INT DEFAULT NULL, file_name VARCHAR(255) NOT NULL, file_type VARCHAR(100) NOT NULL, file_url LONGTEXT NOT NULL, uploaded_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_C7FEE735B93F8B63 (ask_id), INDEX IDX_C7FEE735A8CBA5F7 (lot_id), INDEX IDX_C7FEE7359395C3F3 (customer_id), INDEX IDX_C7FEE735A2B28FE8 (uploaded_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE vtk_materials_category (id INT AUTO_INCREMENT NOT NULL, category_name VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE vtk_materials_lot (id INT AUTO_INCREMENT NOT NULL, ask_id INT DEFAULT NULL, type_id INT DEFAULT NULL, weight_kg NUMERIC(10, 2) DEFAULT NULL, quantity INT DEFAULT NULL, collected_date DATE DEFAULT NULL, processing_status VARCHAR(50) DEFAULT NULL, notes LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_F5AA327DB93F8B63 (ask_id), INDEX IDX_F5AA327DC54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE vtk_materials_type (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, type_name VARCHAR(100) NOT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_28F1B85F12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE vtk_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(100) NOT NULL, email VARCHAR(150) NOT NULL, is_active TINYINT(1) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vtk_audit_log ADD CONSTRAINT FK_192B47B298771930 FOREIGN KEY (related_user_id) REFERENCES vtk_user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vtk_contact ADD CONSTRAINT FK_18CCBEB9395C3F3 FOREIGN KEY (customer_id) REFERENCES vtk_customer (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vtk_customer ADD CONSTRAINT FK_9EAEE34AD905C92C FOREIGN KEY (primary_contact_id) REFERENCES vtk_contact (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vtk_customer_ask ADD CONSTRAINT FK_5D730A9E9395C3F3 FOREIGN KEY (customer_id) REFERENCES vtk_customer (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vtk_document ADD CONSTRAINT FK_C7FEE735B93F8B63 FOREIGN KEY (ask_id) REFERENCES vtk_customer_ask (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vtk_document ADD CONSTRAINT FK_C7FEE735A8CBA5F7 FOREIGN KEY (lot_id) REFERENCES vtk_materials_lot (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vtk_document ADD CONSTRAINT FK_C7FEE7359395C3F3 FOREIGN KEY (customer_id) REFERENCES vtk_customer (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vtk_document ADD CONSTRAINT FK_C7FEE735A2B28FE8 FOREIGN KEY (uploaded_by_id) REFERENCES vtk_user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vtk_materials_lot ADD CONSTRAINT FK_F5AA327DB93F8B63 FOREIGN KEY (ask_id) REFERENCES vtk_customer_ask (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vtk_materials_lot ADD CONSTRAINT FK_F5AA327DC54C8C93 FOREIGN KEY (type_id) REFERENCES vtk_materials_type (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vtk_materials_type ADD CONSTRAINT FK_28F1B85F12469DE2 FOREIGN KEY (category_id) REFERENCES vtk_materials_category (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE vtk_audit_log DROP FOREIGN KEY FK_192B47B298771930
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vtk_contact DROP FOREIGN KEY FK_18CCBEB9395C3F3
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vtk_customer DROP FOREIGN KEY FK_9EAEE34AD905C92C
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vtk_customer_ask DROP FOREIGN KEY FK_5D730A9E9395C3F3
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vtk_document DROP FOREIGN KEY FK_C7FEE735B93F8B63
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vtk_document DROP FOREIGN KEY FK_C7FEE735A8CBA5F7
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vtk_document DROP FOREIGN KEY FK_C7FEE7359395C3F3
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vtk_document DROP FOREIGN KEY FK_C7FEE735A2B28FE8
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vtk_materials_lot DROP FOREIGN KEY FK_F5AA327DB93F8B63
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vtk_materials_lot DROP FOREIGN KEY FK_F5AA327DC54C8C93
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vtk_materials_type DROP FOREIGN KEY FK_28F1B85F12469DE2
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE vtk_audit_log
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE vtk_contact
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE vtk_customer
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE vtk_customer_ask
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE vtk_document
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE vtk_materials_category
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE vtk_materials_lot
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE vtk_materials_type
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE vtk_user
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
