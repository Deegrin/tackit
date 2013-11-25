SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `tackit` ;
CREATE SCHEMA IF NOT EXISTS `tackit` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `tackit` ;

-- -----------------------------------------------------
-- Table `tackit`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tackit`.`user` ;

CREATE TABLE IF NOT EXISTS `tackit`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `active` TINYINT(1) NOT NULL,
  `first_name` VARCHAR(30) NOT NULL,
  `last_name` VARCHAR(30) NULL DEFAULT '',
  `email` VARCHAR(200) NOT NULL,
  `username` VARCHAR(30) NOT NULL,
  `password` VARCHAR(60) NOT NULL,
  `password_salt` VARCHAR(15) NULL,
  `creation_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tackit`.`board`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tackit`.`board` ;

CREATE TABLE IF NOT EXISTS `tackit`.`board` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `private` TINYINT(1) NOT NULL DEFAULT 0,
  `title` VARCHAR(60) NOT NULL,
  `description` VARCHAR(200) NULL DEFAULT '',
  `creation_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `board_user_idx` (`user_id` ASC),
  CONSTRAINT `board_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `tackit`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  FULLTEXT (`title`, `description`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tackit`.`tack`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tackit`.`tack` ;

CREATE TABLE IF NOT EXISTS `tackit`.`tack` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `board_id` INT NOT NULL,
  `title` VARCHAR(60) NOT NULL,
  `description` VARCHAR(200) NULL DEFAULT '',
  `tackUrl` VARCHAR(200) NOT NULL,
  `imageURL` VARCHAR(200) NULL DEFAULT NULL,
  `creation_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `tack_user_idx` (`user_id` ASC),
  INDEX `tack_board_idx` (`board_id` ASC),
  CONSTRAINT `tack_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `tackit`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `tack_board`
    FOREIGN KEY (`board_id`)
    REFERENCES `tackit`.`board` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  FULLTEXT (`title`, `description`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tackit`.`session`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tackit`.`session` ;

CREATE TABLE IF NOT EXISTS `tackit`.`session` (
  `user_id` INT NOT NULL,
  `token` VARCHAR(45) NOT NULL,
  `creation_time` TIMESTAMP NULL,
  `expiration_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`token`),
  CONSTRAINT `session_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `tackit`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tackit`.`relationship`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tackit`.`relationship` ;

CREATE TABLE IF NOT EXISTS `tackit`.`relationship` (
  `user_id` INT NOT NULL,
  `type` INT NOT NULL,
  `object_id` INT NOT NULL,
  `creation_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX `relation_user_idx` (`user_id` ASC),
  CONSTRAINT `relation_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `tackit`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX relationship_unique ON `tackit`.`relationship` (user_id, type, object_id);


-- -----------------------------------------------------
-- Table `tackit`.`account`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tackit`.`account` ;

CREATE TABLE IF NOT EXISTS `tackit`.`account` (
  `user_id` INT NOT NULL,
  `profile_title` VARCHAR(200) NULL,
  `profile_description` VARCHAR(2000) NULL,
  `setting_autoprivate` TINYINT(1) NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `account_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `tackit`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;