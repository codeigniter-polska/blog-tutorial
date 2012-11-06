<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_users extends CI_Migration 
{

	public function up()
	{
		return $this->db->query('
				CREATE  TABLE IF NOT EXISTS `blogtutorial`.`users` (
				  `id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT ,
				  `username` VARCHAR(50) NOT NULL ,
				  `email` VARCHAR(50) NOT NULL ,
				  `password` VARCHAR(40) NOT NULL ,
				  PRIMARY KEY (`id`) ,
				  INDEX `login_idx` (`email` ASC, `password` ASC) )
				ENGINE = InnoDB;
				');
	}

	public function down()
	{
		$this->dbforge->drop_table('users');
	}
}