<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_posts extends CI_Migration 
{

	public function up()
	{
		return $this->db->query('
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
				');
	}

	public function down()
	{
		$this->dbforge->drop_table('posts');
	}
}