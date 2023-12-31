<?php

Class Home extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('martikel');
    }

    public function index()
    {
        $data['title'] = "Home"; 
        $data['artikel'] = $this->martikel->getAllArtikel(6);
        $this->load->view('partials_template/header', $data);
        $this->load->view('partials_template/navbar_template');
        $this->load->view('home/home');
        $this->load->view('partials_template/footer');
    }

    public function artikel($slug)
	{
		// Load the article details from the model based on the $slug
		$article = $this->martikel->getArtikelWhere(['slug' => $slug])->row();

		// Check if the article exists
		if ($article) {
			$data['article'] = $article;
			$data['title'] = $article->title;

			// Load your views
			$this->load->view('partials_template/header', $data);
			$this->load->view('partials_template/navbar_template');
			$this->load->view('home/detail', $data); // Create a new view file (e.g., detail.php)
			$this->load->view('partials_template/footer');
		} else {
			// Article not found, handle appropriately (e.g., show an error message)
			$this->session->set_flashdata('error', 'Article not found.');
			redirect('home'); // Redirect to a default page or handle as needed
		}
	}
}