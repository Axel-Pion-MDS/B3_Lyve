<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220327113755 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answer (id INT AUTO_INCREMENT NOT NULL, question_id INT DEFAULT NULL, answer VARCHAR(255) NOT NULL, is_correct TINYINT(1) NOT NULL, INDEX IDX_DADD4A251E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE answer_user_answer (answer_id INT NOT NULL, user_answer_id INT NOT NULL, INDEX IDX_7E81C13BAA334807 (answer_id), INDEX IDX_7E81C13BAAD3C5E3 (user_answer_id), PRIMARY KEY(answer_id, user_answer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE badge (id INT AUTO_INCREMENT NOT NULL, module_id INT DEFAULT NULL, title VARCHAR(20) NOT NULL, picture VARCHAR(255) NOT NULL, INDEX IDX_FEF0481DAFC2B591 (module_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chapter (id INT AUTO_INCREMENT NOT NULL, module_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_F981B52EAFC2B591 (module_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE collaborator (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, picture VARCHAR(255) NOT NULL, link VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, content LONGTEXT NOT NULL, INDEX IDX_B6BD307FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message_message (message_source INT NOT NULL, message_target INT NOT NULL, INDEX IDX_26350A7368ADE27C (message_source), INDEX IDX_26350A737148B2F3 (message_target), PRIMARY KEY(message_source, message_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offer (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(50) NOT NULL, price NUMERIC(8, 0) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, chapter_id INT DEFAULT NULL, question VARCHAR(255) NOT NULL, INDEX IDX_B6F7494E579F4768 (chapter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, role_id INT DEFAULT NULL, offer_id INT DEFAULT NULL, firstname VARCHAR(30) NOT NULL, lastname VARCHAR(30) NOT NULL, email VARCHAR(100) NOT NULL, birthdate DATE NOT NULL, number NUMERIC(10, 0) NOT NULL, INDEX IDX_8D93D649D60322AC (role_id), INDEX IDX_8D93D64953C674EE (offer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_badge (user_id INT NOT NULL, badge_id INT NOT NULL, INDEX IDX_1C32B345A76ED395 (user_id), INDEX IDX_1C32B345F7A2C2FC (badge_id), PRIMARY KEY(user_id, badge_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_module (user_id INT NOT NULL, module_id INT NOT NULL, INDEX IDX_69763D15A76ED395 (user_id), INDEX IDX_69763D15AFC2B591 (module_id), PRIMARY KEY(user_id, module_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_user_answer (user_id INT NOT NULL, user_answer_id INT NOT NULL, INDEX IDX_1694988DA76ED395 (user_id), INDEX IDX_1694988DAAD3C5E3 (user_answer_id), PRIMARY KEY(user_id, user_answer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_answer (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A251E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE answer_user_answer ADD CONSTRAINT FK_7E81C13BAA334807 FOREIGN KEY (answer_id) REFERENCES answer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE answer_user_answer ADD CONSTRAINT FK_7E81C13BAAD3C5E3 FOREIGN KEY (user_answer_id) REFERENCES user_answer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE badge ADD CONSTRAINT FK_FEF0481DAFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE chapter ADD CONSTRAINT FK_F981B52EAFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message_message ADD CONSTRAINT FK_26350A7368ADE27C FOREIGN KEY (message_source) REFERENCES message (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message_message ADD CONSTRAINT FK_26350A737148B2F3 FOREIGN KEY (message_target) REFERENCES message (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E579F4768 FOREIGN KEY (chapter_id) REFERENCES chapter (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64953C674EE FOREIGN KEY (offer_id) REFERENCES offer (id)');
        $this->addSql('ALTER TABLE user_badge ADD CONSTRAINT FK_1C32B345A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_badge ADD CONSTRAINT FK_1C32B345F7A2C2FC FOREIGN KEY (badge_id) REFERENCES badge (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_module ADD CONSTRAINT FK_69763D15A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_module ADD CONSTRAINT FK_69763D15AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_user_answer ADD CONSTRAINT FK_1694988DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_user_answer ADD CONSTRAINT FK_1694988DAAD3C5E3 FOREIGN KEY (user_answer_id) REFERENCES user_answer (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answer_user_answer DROP FOREIGN KEY FK_7E81C13BAA334807');
        $this->addSql('ALTER TABLE user_badge DROP FOREIGN KEY FK_1C32B345F7A2C2FC');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E579F4768');
        $this->addSql('ALTER TABLE message_message DROP FOREIGN KEY FK_26350A7368ADE27C');
        $this->addSql('ALTER TABLE message_message DROP FOREIGN KEY FK_26350A737148B2F3');
        $this->addSql('ALTER TABLE badge DROP FOREIGN KEY FK_FEF0481DAFC2B591');
        $this->addSql('ALTER TABLE chapter DROP FOREIGN KEY FK_F981B52EAFC2B591');
        $this->addSql('ALTER TABLE user_module DROP FOREIGN KEY FK_69763D15AFC2B591');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64953C674EE');
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A251E27F6BF');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D60322AC');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FA76ED395');
        $this->addSql('ALTER TABLE user_badge DROP FOREIGN KEY FK_1C32B345A76ED395');
        $this->addSql('ALTER TABLE user_module DROP FOREIGN KEY FK_69763D15A76ED395');
        $this->addSql('ALTER TABLE user_user_answer DROP FOREIGN KEY FK_1694988DA76ED395');
        $this->addSql('ALTER TABLE answer_user_answer DROP FOREIGN KEY FK_7E81C13BAAD3C5E3');
        $this->addSql('ALTER TABLE user_user_answer DROP FOREIGN KEY FK_1694988DAAD3C5E3');
        $this->addSql('DROP TABLE answer');
        $this->addSql('DROP TABLE answer_user_answer');
        $this->addSql('DROP TABLE badge');
        $this->addSql('DROP TABLE chapter');
        $this->addSql('DROP TABLE collaborator');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE message_message');
        $this->addSql('DROP TABLE module');
        $this->addSql('DROP TABLE offer');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_badge');
        $this->addSql('DROP TABLE user_module');
        $this->addSql('DROP TABLE user_user_answer');
        $this->addSql('DROP TABLE user_answer');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
