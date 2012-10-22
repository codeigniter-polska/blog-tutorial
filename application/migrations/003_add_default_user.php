<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_default_user extends CI_Migration 
{

	public function up()
	{
		return $this->db->query("INSERT INTO `users` VALUES (1, 'admin', 'admin@admin.dev', SHA1('admin'));");
	}

	public function down()
	{
		return $this->db->query("DELETE FROM `users` WHERE `id` = 1");
	}
}