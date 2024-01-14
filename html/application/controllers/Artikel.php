<?php

class Artikel extends CI_Controller
{
	public Auth $auth;
	public Martikel $martikel;

	function __construct()
	{
		parent::__construct();
		$this->load->library('auth');
		$this->load->model('martikel');
	}

	public function index()
	{
		$this->auth->must_admin();

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('content', 'Content', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Artikel';
			$data['artikel'] = $this->martikel->getAllArtikel();
			$this->load->view('partials_template/header', $data);
			$this->load->view('partials_template/sidebar_template');
			$this->load->view('partials_template/navbar_template');
			$this->load->view('artikel/form_artikel', $data);
			$this->load->view('partials_template/footer');
		} else {
			$payload = [
				'title' => $this->input->post('title'),
				'slug' => url_title($this->input->post('title'), '-', TRUE),
				'content' => $this->input->post('content'),
				'author_id' => $this->session->userdata('id'),
			];

			$this->input->post('id') ? $this->_update($payload) : $this->_add($payload);
			redirect('artikel');
		}
	}

	private function _add($payload)
	{
		$payload['id'] = uniqid($this->session->userdata('id'));

		if (!$this->_uploadImage()) {
			$error = $this->upload->display_errors('<p class="m-0 p-0">', '</p>');
			$this->session->set_flashdata('error', $error);
			return;
		}

		$payload['image_url'] = $this->upload->data()['file_name'];
		if ($this->martikel->createArtikel($payload)) {
			$this->session->set_flashdata('message', 'Article added successfully.');
		} else {
			$this->session->set_flashdata('error', 'Failed to add the article.');
		}
	}

	private function _update($payload)
	{
		$id = $this->input->post('id');

		if ($_FILES['image']['name']) {
			if ($this->_uploadImage()) {
				$artikel = $this->martikel->getArtikelWhere(['id' => $id])->row_array();
				$oldImage = $artikel['image_url'];
				unlink(FCPATH . './uploads/artikel/' . $oldImage);

				$payload['image_url'] = $this->upload->data()['file_name'];
			} else {
				$error = $this->upload->display_errors('<p class="m-0 p-0">', '</p>');
				$this->session->set_flashdata('error', $error);
				return;
			}
		}


		if ($this->martikel->updateArtikel($id, $payload)) {
			$this->session->set_flashdata('message', 'Article updated successfully.');
		} else {
			$this->session->set_flashdata('error', 'Failed to update the article.');
		}
	}

	private function _uploadImage()
	{
		$config['upload_path'] = './uploads/artikel';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = 2000;
		// $config['max_width'] = 1024;
		// $config['max_height'] = 768;

		$this->load->library('upload', $config);

		return $this->upload->do_upload('image');
	}

	public function edit()
	{
		$id = $this->input->post("id");

		$data = $this->martikel->getArtikelWhere(['id' => $id])->result_array();

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function detail($slug)
	{
		$article = $this->martikel->getArtikelWhere(['slug' => $slug])->row();
		if ($article) {
			$data['article'] = $article;
			$data['title'] = $article->title;

			$this->load->view('partials_template/header', $data);
			$this->load->view('partials_template/sidebar_template');
			$this->load->view('partials_template/navbar_template');
			$this->load->view('artikel/detail', $data);
			$this->load->view('partials_template/footer');
		} else {
			$this->session->set_flashdata('error', 'Article not found.');
			redirect('artikel/add');
		}
	}

	public function delete($id)
	{
		$artikel = $this->martikel->getArtikelWhere(['id' => $id])->row_array();
		unlink(FCPATH . './uploads/artikel/' . $artikel['image_url']);

		if ($this->martikel->deleteArtikel($id)) {
			$this->session->set_flashdata('message', 'Article deleted successfully.');
		} else {
			$this->session->set_flashdata('error', 'Failed to delete the article.');
		}

		redirect('artikel');
	}

	public function print()
<<<<<<< HEAD
	{
		$data['artikel'] = $this->martikel->getAllArtikel();
		require_once(APPPATH . 'libraries/dompdf/autoload.inc.php');
		$pdf = new Dompdf\Dompdf();
		$pdf->setPaper('A4', 'potrait');
		$pdf->set_option('isRemoteEnabled', TRUE);
		$pdf->set_option('isHtml5ParserEnabled', true);
		$pdf->set_option('isPhpEnabled', true);
		$pdf->set_option('isFontSubsettingEnabled', true);
		$pdf->loadHtml($this->load->view('artikel/print_artikel', $data, true));
		$pdf->render();
		$pdf->stream('NamaFile', ['Attachment' => false]);
	}
=======
    {
        $data['artikel']=$this->martikel->getAllArtikel();
        require_once(APPPATH . 'libraries/dompdf/autoload.inc.php');
        $pdf = new Dompdf\Dompdf();
        $pdf->setPaper('A4', 'potrait');
        $pdf->set_option('isRemoteEnabled', TRUE);
        $pdf->set_option('isHtml5ParserEnabled', true);
        $pdf->set_option('isPhpEnabled', true);
        $pdf->set_option('isFontSubsettingEnabled', true);
        $pdf->loadHtml($this->load->view('artikel/print_artikel',$data, true));
        $pdf->render();
        $pdf->stream('NamaFile', ['Attachment' => false]);
    }
>>>>>>> ff19c4be921ec0161ce7337aea9abd8dfb3aa28f
}
