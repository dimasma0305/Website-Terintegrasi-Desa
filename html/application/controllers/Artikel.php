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

	public function index()
	{
		$this->auth->must_admin();

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('content', 'Content', 'required');

		if ($this->form_validation->run() == FALSE) 
		{
			$data['title'] = 'Artikel';
			$data['artikel'] = $this->martikel->getAllArtikel();
			$this->load->view('partials_template/header', $data);
			$this->load->view('partials_template/sidebar_template');
			$this->load->view('partials_template/navbar_template');
			$this->load->view('artikel/form_artikel', $data);
			$this->load->view('partials_template/footer');
		}
		else 
		{
			$payload = [
				'title' => $this->input->post('title'),
				'slug' => url_title($this->input->post('title'), '-', TRUE),
				'content' => $this->input->post('content'),
				'author_id' => $this->session->userdata('id'),
				// 'image_url' => 'poto_gussugi.jpg' // Default image URL if upload fails
			];

			($this->input->post('id')) ? $this->_update($payload) : $this->_add($payload);

			// if ($this->input->post('id')) 
			// {
			// 	$this->_update($payload);
			// }
			// else 
			// {
			// 	$this->_add($payload);
			// }
			redirect('artikel');
		}
	}

	private function _add($payload)
	{
		$payload['id'] = uniqid($this->session->userdata('id'));

		if (!$this->_uploadImage()) 
		{
			$error = $this->upload->display_errors('<p class="m-0 p-0">', '</p>');
			$this->session->set_flashdata('error', $error);
			return;
		} 

		$payload['image_url'] = $this->upload->data()['file_name'];
		if ($this->martikel->createArtikel($payload)) 
		{
			$this->session->set_flashdata('message', 'Article added successfully.');
		} 
		else 
		{
			$this->session->set_flashdata('error', 'Failed to add the article.');
		}
	}

	private function _update($payload)
	{
		$id = $this->input->post('id');

		// Check image
		if ($_FILES['image']['name']) 
		{
			if ($this->_uploadImage())
			{
				$artikel = $this->martikel->getArtikelWhere(['id'=>$id])->row_array();
				// Delete old image
				$oldImage = $artikel['image_url'];
				unlink(FCPATH. './uploads/artikel/'.$oldImage);

				$payload['image_url'] = $this->upload->data()['file_name'];
			}
			else
			{
				$error = $this->upload->display_errors('<p class="m-0 p-0">', '</p>');
				$this->session->set_flashdata('error', $error);
				return;
			}
		}
		

		if ($this->martikel->updateArtikel($payload, $id)) 
		{
			$this->session->set_flashdata('message', 'Article updated successfully.');
		} 
		else 
		{
			$this->session->set_flashdata('error', 'Failed to update the article.');
		}
	}

	private function _uploadImage()
	{
		$config['upload_path'] = './uploads/artikel';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = 2000;
		// $config['max_width'] = 1024;
		// $config['max_height'] = 768;

		$this->load->library('upload', $config);

		return $this->upload->do_upload('image');
	}

	public function edit()
	{
		$id = $this->input->post("id");

		$data= $this->martikel->getArtikelWhere(['id'=>$id])->result_array();

		// var_dump($data);die;

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	// Add this method to your Artikel controller
	public function detail($slug)
	{
		// Load the article details from the model based on the $slug
		$article = $this->martikel->getArtikelWhere(['slug' => $slug])->row();

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

	public function delete($id){
		$artikel = $this->martikel->getArtikelWhere(['id' => $id])->row_array();
		
		unlink(FCPATH.'./uploads/artikel/'.$artikel['image_url']);
		
		if ($this->martikel->deleteArtikel($id)) 
		{
			$this->session->set_flashdata('message', 'Article deleted successfully.');
		} 
		else 
		{
			$this->session->set_flashdata('error', 'Faled to delete the article.');
		}

		redirect('artikel');
	}

	// Gk kepake
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

	// public function delete(){
	// 	$id = $this->input->get("id");
	// 	if ($_SERVER['REQUEST_METHOD'] == "DELETE"){
	// 		$this->martikel->deleteArtikel($id);
	// 	}
	// 	$this->output->set_content_type('application/json')->set_output(json_encode(['message'=>'ok']));
	// }
}
