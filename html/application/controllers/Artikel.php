<?php

class Artikel extends CI_Controller
{
	public Auth $auth;
	public Martikel $martikel;

	function __construct()
	{
		parent::__construct();
		$this->load->library('auth');
		$this->load->model('martikel'); // Load the Martikel model
		$this->load->library('session'); // Load the session library
	}

	public function add()
	{
		$this->auth->must_admin();
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('content', 'Content', 'required');

			if ($this->form_validation->run() == false) {
				// Validation failed, set an error flash message
				$this->session->set_flashdata('error', 'Please fill in all required fields.');
				$this->load->view('add_article');
			} else {
				// Validation passed, add the article to the database
				$title = $this->input->post('title');
				$content = $this->input->post('content');
				$authorId = $this->session->userdata('id'); // Assuming user ID is stored in the session

				$articleId = $this->martikel->createArtikel($title, $content, $authorId);

				if ($articleId) {
					// Article added successfully, redirect to the article detail page
					redirect('artikel/detail/' . $articleId);
				} else {
					// Failed to add article, set an error flash message
					$this->session->set_flashdata('error', 'Failed to add the article.');
					$data['title'] = 'Tambah Artikel';
					$this->load->view('partials_template/header', $data);
					$this->load->view('partials_template/sidebar_template');
					$this->load->view('partials_template/navbar_template');
					$this->load->view('artikel/add_article', $data);
					$this->load->view('partials_template/footer');
				}
			}
		} else {
			$data['title'] = 'Tambah Artikel';
			$this->load->view('partials_template/header', $data);
			$this->load->view('partials_template/sidebar_template');
			$this->load->view('partials_template/navbar_template');
			$this->load->view('artikel/add_article', $data);
			$this->load->view('partials_template/footer');
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
