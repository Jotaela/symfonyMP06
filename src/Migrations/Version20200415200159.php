<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200415200159 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE habitat_animal (habitat_id INT NOT NULL, animal_id INT NOT NULL, INDEX IDX_C0FE85A4AFFE2D26 (habitat_id), INDEX IDX_C0FE85A48E962C16 (animal_id), PRIMARY KEY(habitat_id, animal_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE habitat_animal ADD CONSTRAINT FK_C0FE85A4AFFE2D26 FOREIGN KEY (habitat_id) REFERENCES habitat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE habitat_animal ADD CONSTRAINT FK_C0FE85A48E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE animals_habitats');
        $this->addSql('ALTER TABLE habitat CHANGE descripcio descripcio VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE animals_habitats (animal_id INT NOT NULL, habitat_id INT NOT NULL, INDEX IDX_36E119A28E962C16 (animal_id), INDEX IDX_36E119A2AFFE2D26 (habitat_id), PRIMARY KEY(animal_id, habitat_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE animals_habitats ADD CONSTRAINT FK_36E119A28E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE animals_habitats ADD CONSTRAINT FK_36E119A2AFFE2D26 FOREIGN KEY (habitat_id) REFERENCES habitat (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE habitat_animal');
        $this->addSql('ALTER TABLE habitat CHANGE descripcio descripcio VARCHAR(1000) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
