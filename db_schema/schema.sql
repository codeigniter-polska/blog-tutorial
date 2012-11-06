SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `blogtutorial` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `blogtutorial` ;

-- -----------------------------------------------------
-- Table `blogtutorial`.`users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `blogtutorial`.`users` (
  `id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(50) NOT NULL ,
  `email` VARCHAR(50) NOT NULL ,
  `password` VARCHAR(40) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `login_idx` (`email` ASC, `password` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `blogtutorial`.`posts`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `blogtutorial`.`posts` (
  `id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(100) NOT NULL ,
  `body` TEXT NOT NULL ,
  `user_id` MEDIUMINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_posts_user_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_posts_users`
    FOREIGN KEY (`user_id` )
    REFERENCES `blogtutorial`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;