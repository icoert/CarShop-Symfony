<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210210094908 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, delivery_address_id INT NOT NULL, phone VARCHAR(15) NOT NULL, UNIQUE INDEX UNIQ_81398E09A76ED395 (user_id), UNIQUE INDEX UNIQ_81398E09EBF23851 (delivery_address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE delivery_address (id INT AUTO_INCREMENT NOT NULL, city VARCHAR(50) NOT NULL, street VARCHAR(50) NOT NULL, number INT DEFAULT NULL, other_details INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employee (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, rate INT DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, started_date DATE NOT NULL, no_rates INT DEFAULT NULL, UNIQUE INDEX UNIQ_5D9F75A1A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, customer_id INT NOT NULL, created_date DATE NOT NULL, amount NUMERIC(10, 2) NOT NULL, status VARCHAR(50) NOT NULL, delivery_date DATE NOT NULL, INDEX IDX_F52993989395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_details (id INT AUTO_INCREMENT NOT NULL, customer_order_id INT NOT NULL, product_id INT NOT NULL, quantity NUMERIC(10, 2) NOT NULL, INDEX IDX_845CA2C1A15A2E17 (customer_order_id), INDEX IDX_845CA2C14584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, employee_id INT NOT NULL, category_id INT NOT NULL, name VARCHAR(100) NOT NULL, price NUMERIC(10, 2) NOT NULL, produced_date DATE NOT NULL, quantity NUMERIC(10, 2) DEFAULT NULL, measure_unit VARCHAR(100) NOT NULL, INDEX IDX_D34A04AD8C03F15C (employee_id), INDEX IDX_D34A04AD12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(50) NOT NULL, password VARCHAR(1000) NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, is_admin TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09EBF23851 FOREIGN KEY (delivery_address_id) REFERENCES delivery_address (id)');
        $this->addSql('ALTER TABLE employee ADD CONSTRAINT FK_5D9F75A1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993989395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE order_details ADD CONSTRAINT FK_845CA2C1A15A2E17 FOREIGN KEY (customer_order_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE order_details ADD CONSTRAINT FK_845CA2C14584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD8C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993989395C3F3');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E09EBF23851');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD8C03F15C');
        $this->addSql('ALTER TABLE order_details DROP FOREIGN KEY FK_845CA2C1A15A2E17');
        $this->addSql('ALTER TABLE order_details DROP FOREIGN KEY FK_845CA2C14584665A');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E09A76ED395');
        $this->addSql('ALTER TABLE employee DROP FOREIGN KEY FK_5D9F75A1A76ED395');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE delivery_address');
        $this->addSql('DROP TABLE employee');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_details');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE user');
    }
}
