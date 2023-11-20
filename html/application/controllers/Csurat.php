<?php

class Csurat extends CI_Controller
{
	public Msurat $msurat;
	function __construct()
	{
		parent::__construct();
		if (!isset($this->session->get_userdata()['id'])) {
			redirect(base_url('cindex/login'), 'refresh');
			exit();
		}
		$this->load->model('msurat');
	}

	function index()
	{
		$jenisSurat = $this->msurat->getJenisSurat();
		$this->load->view('includes/header');
		$this->load->view('partials/navbar');
		$this->load->view('formSurat', array('jenisSurat' => $jenisSurat));
		$this->load->view('includes/footer');
	}
	function surat()
	{
		switch ($this->input->method()) {
			case 'get':
				$suratData = $this->msurat->getSuratByOwner($this->session->userdata('id'));
				$this->load->view('includes/header');
				$this->load->view('partials/navbar');
				$this->load->view('viewSurat', array('suratData' => $suratData));
				$this->load->view('includes/footer');
				break;
			case 'post':
				$jenisSuratId = $this->input->post('jenisSuratId');
				$fileData = $_FILES['surat'];
				$tmpname = $fileData['tmp_name'];
				$title = pathinfo($fileData['name'])['filename'];
				$deskripsi = $this->input->post('deskripsi');
				$keperluan = $this->input->post('keperluan');

				// Check if the file is a PDF using finfo
				$finfo = new finfo(FILEINFO_MIME_TYPE);
				$fileMimeType = $finfo->file($tmpname);
				if ($fileMimeType !== 'application/pdf') {
					$this->session->set_flashdata('error', 'Invalid file format. Please upload a PDF file.');
					redirect(base_url('csurat'), 'refresh');
					return;
				}

				$randomFilename = $this->generateRandomPdfFilename();

				$uploadDir = './uploads/surat/';
				$uploadPath = $uploadDir . $randomFilename;

				if (!move_uploaded_file($tmpname, $uploadPath)) {
					$this->session->set_flashdata('error', 'Surat gagal disimpan');
					redirect(base_url('csurat'), 'refresh');
					return;
				}

				$suratData = array(
					'owner' => $this->session->userdata('id'),
					'title' => $title,
					'filename' => $randomFilename,
					'jenisSuratId' => $jenisSuratId,
					'deskripsi' => $deskripsi,
					'keperluan' => $keperluan,
					'status' => "pending"
				);

				$this->msurat->addSurat($suratData);
				$this->session->set_flashdata('message', 'Surat added successfully!');
				redirect(base_url('csurat'), 'refresh');
				break;
			default:
				$this->output->set_status_header(405);
				echo 'Method not allowed';
				break;
		}
	}
	function edit($id){
		$surat = $this->msurat->getSuratByIdAndOwnerId($id, $this->session->get_userdata()['id']);
		if (!$surat){
			return;
		}
	}
	private function generateRandomPdfFilename()
	{
		$randomFilename = uniqid() . '_' . bin2hex(random_bytes(8)) . '.pdf';
		return $randomFilename;
	}
}
