<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller
{
	// W tej tablicy przechowujemy nazwy metod, do których ma dostęp jedynie zalogowany użytkownik
	public $restricted = array('add', 'edit');

	public function __construct()
	{
		parent::__construct();
		// Ładujemy bibilotekę sesji
		$this->load->library('session');

		// Sprawdzamy, czy obecnie wywoływana metoda znajduje się w tablicy $resricted
		if (in_array($this->uri->rsegment(2), $this->restricted))
		{
			// Sprawdzamy, czy użytkownik jest zalogowany poprzez sprawdzenie istnienia zmiennej sesyjnej 'user_id'.
			// Ta zmienna jest ustawiana tylko w momencie poprawnego zalogowania.
			if ( ! $this->session->userdata('user_id'))
			{
				// Wyświetlamy stonę błędu, ale równie dobrze możemy zwrócic inny komunikat,
				// np. taki, który informuje o konieczności zalogowania do aplikacji lub 
				// przekierować użytkownika do strony logowania.
				show_404();
			}
		}
		// Ładujemy bibliotekę walidacji formularza
		$this->load->library('form_validation');
		// Określamy jakie tagi będą otaczać komunikat błędu walidacji. 
		// To kwestia stricte kosmetyczna - dostosowanie wyglądu do Twitter Bootstrap.
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">×</a>', '</div>');

		// Ładujemy model
		$this->load->model('post_model');
	}

	public function index()
	{
		// Ładujemy bibliotekę odpowiedzialną za stronicowanie
		$this->load->library('pagination');

		// Określamy początkowy adres url dla paginacji
		$config['base_url'] = site_url('posts/index/');
		// Zliczamy ilość wszystkich wpisów
		$config['total_rows'] = $this->post_model->count_all();
		// Określamy liczbę wpisów na stronie
		$config['per_page'] = 1;

        // Zmienne odpowiedzialne za ustalenie wyglądu paginacji (dla Twitter Bootstrap)
        $config['full_tag_open'] = '<div class="pagination"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&larr;';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&rarr;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] =  '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        
        // Inicjalizujemy bibliotekę paginacji z powyższymi ustawieniami
        $this->pagination->initialize($config);

        // Przypisujemy do zmiennej numery dostępnych stron
        $data['pagination'] = $this->pagination->create_links();
        
		// Wczytujemy wpisy, jako parametry podając kryteria
		$data['posts'] = $this->post_model->get_all($config['per_page'], $this->uri->rsegment(3));

		// Zwracamy widoki, przypisując do jednego z nich tablicę $data
		$this->load->view('partials/header');
		$this->load->view('post_index', $data);
		$this->load->view('partials/footer');
	}

	public function add()
	{	
		// Ustalamy reguły walidacji
		$this->form_validation->set_rules('title', 'Tytuł', 'required|trim');
		$this->form_validation->set_rules('body', 'Treść', 'required|trim');

		// Sprawdzamy, czy formularz został wysłany i czy wystąpiły błędy walidacji
		if ($this->form_validation->run() == FALSE)
		{
			// Wyświetlamy widoki - ewentualne błędy walidacji zostaną przekazane automatycznie
			$this->load->view('partials/header');
			$this->load->view('post_add');
			$this->load->view('partials/footer');
		}
		else
		{
			// Przypisujemy zmienne POST z formularza do tablicy $data
			$data['title'] = $this->input->post('title');
			$data['body'] = $this->input->post('body');
			// Ustawiamy zmienną $data['user_id'] na identyfikator zalogowanego użytkownika, 
			// który przechowujemy w sesji (ustawiany jest w momencie logowania). 
			$data['user_id'] = $this->session->userdata('user_id');
			// Wysyłamy tablicę $data do modelu i w zależności od zwróconego wyniku wykonujemy poniższe czynności
			if ($this->post_model->add($data))
			{
				// Ustawiamy zmienną flashadata o nazwie success i przypisujemy do niej komunikat o powodzeniu dodania wpisu.
				$this->session->set_flashdata('success', 'Wpis został dodany.');				
			}
			else
			{
				// Ustawiamy zmienną flashadata o nazwie error i przypisujemy do niej komunikat o błędzie.
				$this->session->set_flashdata('error', 'Wystąpił błąd i wpis nie mógł zostać dodany.');
			}
			// Przekierowujemy użytkownika pod adres http://localhost/blogtutorial/index.php/posts
			redirect('posts');
		}
	}

	public function edit($id)
	{
		// Ustalamy reguły walidacji
		$this->form_validation->set_rules('title', 'Tytuł', 'required|trim');
		$this->form_validation->set_rules('body', 'Treść', 'required|trim');

		// Sprawdzamy, czy formularz został wysłany i czy wystąpiły błędy walidacji
		if ($this->form_validation->run() == FALSE)
		{
			// Pobieramy dane z modelu po zmiennej $id
			$data = $this->post_model->get($id);

			// Przypisujemy otrzymane dane do widoku
			// Ewentualne błędy walidacji zostaną przekazane automatycznie
			$this->load->view('partials/header');
			$this->load->view('post_edit', $data);
			$this->load->view('partials/footer');
		}
		else
		{
			// Przypisujemy zmienne POST z formularza do tablicy $data
			$data['title'] = $this->input->post('title');
			$data['body'] = $this->input->post('body');

			// Wysyłamyzmienną $id i tablicę $data do modelu i w zależności od zwróconego wyniku wykonujemy poniższe czynności
			if ($this->post_model->update($id, $data))
			{
				// Ustawiamy zmienną flashadata o nazwie success i przypisujemy do niej komunikat o powodzeniu dodania wpisu.
				$this->session->set_flashdata('success', 'Wpis został zaktualizowany.');
				// Przekierowujemy użytkownika pod adres http://localhost/blogtutorial/index.php/posts	
				redirect('posts');			
			}
			else
			{
				// Ustawiamy zmienną flashadata o nazwie error i przypisujemy do niej komunikat o błędzie.
				$this->session->set_flashdata('error', 'Wystąpił błąd i wpis nie mógł zostac zaktualizowany.');
				// Przekierowujemy użytkownika pod adres edycji wpisu http://localhost/blogtutorial/index.php/posts/edit/numer_id_wpisu	
				redirect('posts/edit/'. $id);
			}
		}
	}
	
}
/* End of file posts.php */
/* Location: ./application/controllers/posts.php */