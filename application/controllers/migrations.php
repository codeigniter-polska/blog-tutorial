<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migrations extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// Sprawdzamy, czy wywołanie klasy nie odbyło się z poziomu linii komend
		if ( ! $this->input->is_cli_request())
		{
			show_error("Aby skorzystac z migracji wykonaj polecenie z linii komend: php index.php migrations");
		}
		$this->load->library('migration');
	}

	/**
	 * Zwraca listę dostępnych komend wraz z opisem
	 *
	 * @access	public
	 */
	public function index()
	{
		print("\n\nDostepne sa nastepujace komendy:\n\n");
		print("php index.php migrations/latest - migruje baze danych do ostatniej wersji\n");
		print("php index.php migrations/version/:id - migruje baze danych do wybranej wersji (parametr :id nalezy zastapic numerem wersji migracji)\n");
	}

	/**
	 * Migruje bazę danych do ostatniej dostępnej wersji
	 *
	 * @access	public
	 */
	public function latest()
	{
		if ( ! $this->migration->current())
		{
			print($this->migration->error_string());
		}
		else
		{
			print("Poprawnie wykonano migracje bazy danych, do ostatniej dostepnej wersji.");
		}
	}

	/**
	 * Migruje bazę do wersji podanej w parametrze
	 *
	 * @access	public
	 * @param	int	Numer wersji
	 */
	public function version($number)
	{
		if ( ! $this->migration->version($number))
		{
			print($this->migration->error_string());
		}
		else
		{
			print("Poprawnie wykonano migracje bazy danych do wersji ". $number);
		}
	}

}
/* End of file migrations.php */
/* Location: ./application/controllers/migrations.php */