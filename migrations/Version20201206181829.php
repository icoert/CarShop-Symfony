<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201206181829 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE reservation_coupon');
        $this->addSql('DROP TABLE reservation_reservation_status');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservation_coupon (reservation_id INT NOT NULL, coupon_id INT NOT NULL, INDEX IDX_2C4E7699B83297E7 (reservation_id), INDEX IDX_2C4E769966C5951B (coupon_id), PRIMARY KEY(reservation_id, coupon_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reservation_reservation_status (reservation_id INT NOT NULL, reservation_status_id INT NOT NULL, INDEX IDX_197D6B47B83297E7 (reservation_id), INDEX IDX_197D6B4771B06122 (reservation_status_id), PRIMARY KEY(reservation_id, reservation_status_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE reservation_coupon ADD CONSTRAINT FK_2C4E769966C5951B FOREIGN KEY (coupon_id) REFERENCES coupon (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_coupon ADD CONSTRAINT FK_2C4E7699B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_reservation_status ADD CONSTRAINT FK_197D6B4771B06122 FOREIGN KEY (reservation_status_id) REFERENCES reservationstatus (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_reservation_status ADD CONSTRAINT FK_197D6B47B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE');
    }
}
