<?php

class Surat extends CI_Controller
{
	public Msurat $msurat;
	function __construct()
	{
		parent::__construct();
		if (!isset($this->session->get_userdata()['id'])) {
            redirect(base_url('index/login?r='.$this->uri->uri_string()));
			exit();
		}
		$this->load->model('msurat');
	}

	private function loadViewWithFooterAndHeader($name, $vars = [])
	{
		$this->load->view('includes/header');
		$this->load->view('partials/navbar');
		$this->load->view($name, $vars);
		$this->load->view('includes/footer');
	}

	function index()
	{
		$jenisSurat = $this->msurat->getJenisSurat();
		$this->loadViewWithFooterAndHeader('surat/form', ['jenisSurat' => $jenisSurat]);
	}
	private function createFile($files, $filename)
	{
		$tmpname = $files["tmp_name"];
		$finfo = new finfo(FILEINFO_MIME_TYPE);
		$fileMimeType = $finfo->file($tmpname);
		if ($fileMimeType !== 'application/pdf') {
			$this->session->set_flashdata('error', 'Invalid file format. Please upload a PDF file.');
			return false;
		}
		$uploadDir = './uploads/surat/';
		$uploadPath = $uploadDir . $filename;
		if (!move_uploaded_file($tmpname, $uploadPath)) {
			$this->session->set_flashdata('error', 'Surat gagal disimpan');
			return false;
		}
		return true;
	}
	function list()
	{
		switch ($this->input->method()) {
			case 'get':
				$suratData = $this->msurat->getSuratByOwner($this->session->userdata('id'));
				$this->loadViewWithFooterAndHeader('surat/list', ['suratData' => $suratData]);
				break;
			case 'post':
				$jenisSuratId = $this->input->post('jenisSuratId');
				$files = $_FILES['surat'];
				$title = pathinfo($files['name'])['filename'];
				$deskripsi = $this->input->post('deskripsi');
				$keperluan = $this->input->post('keperluan');
				$filename = $this->generateRandomPdfFilename();
				if (!$this->createFile($files, $filename)) {
					redirect(base_url('surat'), 'refresh');
					return;
				}
				$this->msurat->addSurat([
					'owner' => $this->session->userdata('id'),
					'title' => $title,
					'filename' => $filename,
					'jenisSuratId' => $jenisSuratId,
					'deskripsi' => $deskripsi,
					'keperluan' => $keperluan,
					'status' => "pending"
				]);
				$this->session->set_flashdata('message', 'Surat added successfully!');
				redirect(base_url('surat'), 'refresh');
				break;
			default:
				$this->output->set_status_header(405);
				echo 'Method not allowed';
				break;
		}
	}
	function edit($id)
	{
		switch ($this->input->method()) {
			case "get":
				$surat = $this->msurat->getSuratByIdAndOwnerId($id, $this->session->get_userdata()['id']);
				if (!$surat) {
					$this->output->set_status_header(404);
					$this->load->view("errors/html/error_404", array("heading" => "404", "message" => "Surat not found!"));
					return;
				}
				$jenisSurat = $this->msurat->getJenisSurat();
				$this->loadViewWithFooterAndHeader('surat/edit', ['surat' => $surat, 'jenisSurat' => $jenisSurat]);
				break;
			case "post":
				$jenisSuratId = $this->input->post('jenisSuratId');
				$deskripsi = $this->input->post('deskripsi');
				$keperluan = $this->input->post('keperluan');
				$updateData = array();

				if (!empty($_FILES['surat']['tmp_name'])) {
					$files = $_FILES['surat'];
					$title = pathinfo($files['name'])['filename'];

					$filename = $this->generateRandomPdfFilename();
					if (!$this->createFile($files, $filename)) {
						redirect(base_url('surat/edit/' . $id), 'refresh');
						return;
					}
					$updateData = array(
						'filename' => $filename,
						'title' => $title
					);
				}
				$updateData += array(
					'jenisSuratId' => $jenisSuratId,
					'deskripsi' => $deskripsi,
					'keperluan' => $keperluan,
				);
				$this->msurat->updateSurat($id, $updateData);
				$this->session->set_flashdata('message', 'Surat updated successfully!');
				redirect(base_url('surat/edit/' . $id), 'refresh');
				break;
		}
	}
	private function generateRandomPdfFilename()
	{
		$randomFilename = uniqid() . '_' . bin2hex(random_bytes(8)) . '.pdf';
		return $randomFilename;
	}
}
