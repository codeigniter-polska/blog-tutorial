<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
	// Nazwa tabeli, z której będziemy korzystać w modelu
	public $table = 'users';
	
	/**
	 * Logowanie użytkownika 
	 * Sprawdza, czy użytkownik o podanym adresie email i haśle istnieje w bazie danych
	 *
	 * @access	public
	 * @return	mixed
	 */
	public function login($email, $password)
	{
		// Jeśli w bazie zostanie znaleziony użytkownik o podanym adresie email i haśle, 
		// to wynik zostanie zwrócony do kontrolera w postaci tablicy, w innym wypadku otrzymamy pusty wynik.
		return $this->db->where(array('email' => $email, 'password' => $password))->get($this->table)->row_array();
	}
}

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */