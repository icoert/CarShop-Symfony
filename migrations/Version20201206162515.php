<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201206162515 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE car (id INT AUTO_INCREMENT NOT NULL, plate VARCHAR(255) NOT NULL, manufacturer VARCHAR(255) NOT NULL, model VARCHAR(255) NOT NULL, pricerPerDay DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coupon (id INT AUTO_INCREMENT NOT NULL, couponCode INT NOT NULL, discount VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, birthDate DATETIME NOT NULL, location VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, car_id INT DEFAULT NULL, customer_id INT DEFAULT NULL, startDate DATETIME NOT NULL, endDate DATETIME NOT NULL, location VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_42C84955C3C6F69F (car_id), UNIQUE INDEX UNIQ_42C849559395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation_reservation_status (reservation_id INT NOT NULL, reservation_status_id INT NOT NULL, INDEX IDX_197D6B47B83297E7 (reservation_id), INDEX IDX_197D6B4771B06122 (reservation_status_id), PRIMARY KEY(reservation_id, reservation_status_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation_coupon (reservation_id INT NOT NULL, coupon_id INT NOT NULL, INDEX IDX_2C4E7699B83297E7 (reservation_id), INDEX IDX_2C4E769966C5951B (coupon_id), PRIMARY KEY(reservation_id, coupon_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservationstatus (id INT AUTO_INCREMENT NOT NULL, status VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849559395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE reservation_reservation_status ADD CONSTRAINT FK_197D6B47B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_reservation_status ADD CONSTRAINT FK_197D6B4771B06122 FOREIGN KEY (reservation_status_id) REFERENCES reservationstatus (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_coupon ADD CONSTRAINT FK_2C4E7699B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_coupon ADD CONSTRAINT FK_2C4E769966C5951B FOREIGN KEY (coupon_id) REFERENCES coupon (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955C3C6F69F');
        $this->addSql('ALTER TABLE reservation_coupon DROP FOREIGN KEY FK_2C4E769966C5951B');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849559395C3F3');
        $this->addSql('ALTER TABLE reservation_reservation_status DROP FOREIGN KEY FK_197D6B47B83297E7');
        $this->addSql('ALTER TABLE reservation_coupon DROP FOREIGN KEY FK_2C4E7699B83297E7');
        $this->addSql('ALTER TABLE reservation_reservation_status DROP FOREIGN KEY FK_197D6B4771B06122');
        $this->addSql('DROP TABLE car');
        $this->addSql('DROP TABLE coupon');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE reservation_reservation_status');
        $this->addSql('DROP TABLE reservation_coupon');
        $this->addSql('DROP TABLE reservationstatus');
    }
}
