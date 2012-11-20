<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Post_model extends CI_Model
{
	// Nazwa tabeli, z której będziemy korzystać w modelu
	public $table = 'posts';
	
	/**
	 * Zwraca wpisy z podanego przedziału
	 *
	 * @access	public
	 * @param	int Limit
	 * @param	int Offset
	 * @return	mixed
	 */
	public function get_all($limit, $offset)
	{
		return $this->db
					->limit($limit, $offset)
					->order_by($this->table.'.id', 'desc')
					->get($this->table)
					->result_array();
	}

	/**
	 * Zwraca łączną liczbę wszystkich wpisów w tabeli
	 *
	 * @access	public
	 * @return	int
	 */
	public function count_all()
	{
		return $this->db->count_all($this->table);
	}

	/**
	 * Zwraca wpisy o podanym numerze Id
	 *
	 * @access	public
	 * @param	int Numer Id wpisu
	 * @return	mixed
	 */
	public function get($id)
	{
		return $this->db->where('id', $id)->get($this->table)->row_array();
	}

	/**
	 * Dodaje wpis do tabeli
	 *
	 * @access	public
	 * @param	array Dane do dodania
	 * @return	bool
	 */
	public function add($data)
	{
		return $this->db->insert($this->table, $data);
	}

	/**
	 * Aktualizuje wpis w tabeli
	 *
	 * @access	public
	 * @param	int	Numer Id
	 * @param	array Dane do zaktualizowania
	 * @return	bool
	 */
	public function update($id, $data)
	{
		return $this->db->where('id', $id)->update($this->table, $data);
	}
}
/* End of file user_model.php */
/* Location: ./application/models/user_model.php */