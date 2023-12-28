<?php

class Artikel extends CI_Controller
{
	public Auth $auth;
	// public Martikel $martikel;

	function __construct()
	{
		parent::__construct();
		$this->load->library('auth');
		$this->load->model('martikel'); // Load the Martikel model
	}

	public function add()
	{
		$this->auth->must_admin();

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('content', 'Content', 'required');

		if ($this->form_validation->run() == FALSE) 
		{
			$data['title'] = 'Tambah Artikel';
			$this->load->view('partials_template/header', $data);
			$this->load->view('partials_template/sidebar_template');
			$this->load->view('partials_template/navbar_template');
			$this->load->view('artikel/form_artikel', $data);
			$this->load->view('partials_template/footer');
		}
		else 
		{
			$payload = [
				'id' => uniqid($this->session->userdata('id')),
				'title' => $this->input->post('title'),
				'slug' => url_title($this->input->post('title'), '-', TRUE),
				'content' => $this->input->post('content'),
				'author_id' => $this->session->userdata('id'),
				'image_url' => 'poto_gussugi.jpg' // Default image URL if upload fails
			];
		
			$image = $_FILES;
		
			if ($image) {
				$config['upload_path'] = './uploads/artikel';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = 2000;
				// $config['max_width'] = 1024;
				// $config['max_height'] = 768;
		
				$this->load->library('upload', $config);
		
				if (!$this->upload->do_upload('image')) {
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('error', $error);
				} else {
					$payload['image_url'] = $this->upload->data()['file_name'];
					if ($this->martikel->createArtikel($payload)) {
						$this->session->set_flashdata('message', 'Article added successfully.');
					} else {
						$this->session->set_flashdata('error', 'Failed to add the article.');
					}
				}
			} else {
				if ($this->martikel->createArtikel($payload)) {
					$this->session->set_flashdata('message', 'Article added successfully.');
				} else {
					$this->session->set_flashdata('error', 'Failed to add the article.');
				}
			}
			redirect('artikel/add');
		}
		
	}

	// Add this method to your Artikel controller
	public function detail($articleId)
	{
		// Load the article details from the model based on the $articleId
		$article = $this->martikel->getArtikelById($articleId);

		// Check if the article exists
		if ($article) {
			$data['article'] = $article;
			$data['title'] = $article->title;

			// Load your views
			$this->load->view('partials_template/header', $data);
			$this->load->view('partials_template/sidebar_template');
			$this->load->view('partials_template/navbar_template');
			$this->load->view('artikel/detail', $data); // Create a new view file (e.g., detail.php)
			$this->load->view('partials_template/footer');
		} else {
			// Article not found, handle appropriately (e.g., show an error message)
			$this->session->set_flashdata('error', 'Article not found.');
			redirect('artikel/add'); // Redirect to a default page or handle as needed
		}
	}
	
	public function list()
	{
		$data['title'] = 'List Artikel';
		$data['artikel'] = $this->martikel->getAllArtikel(); // Assuming you have a method to get all articles
		$this->load->view('partials_template/header', $data);
		$this->load->view('partials_template/sidebar_template');
		$this->load->view('partials_template/navbar_template');
		$this->load->view('artikel/list_artikel', $data); // Create a new view file (e.g., list_articles.php)
		$this->load->view('partials_template/footer');
	}

	public function delete(){
		$id = $this->input->get("id");
		if ($_SERVER['REQUEST_METHOD'] == "DELETE"){
			$this->martikel->deleteArtikel($id);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(['message'=>'ok']));
	}
}
