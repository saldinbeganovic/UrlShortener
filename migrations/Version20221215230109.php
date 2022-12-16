<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221215230109 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE app_users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(25) NOT NULL, password VARCHAR(64) NOT NULL, email VARCHAR(190) NOT NULL, is_active TINYINT(1) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_C2502824F85E0677 (username), UNIQUE INDEX UNIQ_C2502824E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statistic (id INT AUTO_INCREMENT NOT NULL, url_id_id INT NOT NULL, clicks INT DEFAULT NULL, UNIQUE INDEX UNIQ_649B469CBAE0F120 (url_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE url (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, original_url VARCHAR(500) NOT NULL, shortened_url VARCHAR(300) NOT NULL, INDEX IDX_F47645AE9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE statistic ADD CONSTRAINT FK_649B469CBAE0F120 FOREIGN KEY (url_id_id) REFERENCES url (id)');
        $this->addSql('ALTER TABLE url ADD CONSTRAINT FK_F47645AE9D86650F FOREIGN KEY (user_id_id) REFERENCES app_users (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE statistic DROP FOREIGN KEY FK_649B469CBAE0F120');
        $this->addSql('ALTER TABLE url DROP FOREIGN KEY FK_F47645AE9D86650F');
        $this->addSql('DROP TABLE app_users');
        $this->addSql('DROP TABLE statistic');
        $this->addSql('DROP TABLE url');
    }
}
