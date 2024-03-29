<?php

class Surat extends CI_Controller
{
	public Msurat $msurat;
	public Auth $auth;
	function __construct()
	{
		parent::__construct();
		$this->load->library('auth');
		$this->auth->must_login();
		$this->load->model('msurat');
	}
	function index()
	{
		$jenisSurat = $this->msurat->getJenisSurat();

		$data['title'] = 'Form Surat';
		$data['jenisSurat'] = $jenisSurat;
		$this->load->view('partials_template/header', $data);
		$this->load->view('partials_template/sidebar_template');
		$this->load->view('partials_template/navbar_template');
		$this->load->view('surat/form', $data);
		$this->load->view('partials_template/footer');
	}

	// private function createFile($files, $filename)
	// {
	// 	$tmpname = $files["tmp_name"];
	// 	$finfo = new finfo(FILEINFO_MIME_TYPE);
	// 	$fileMimeType = $finfo->file($tmpname);
	// 	if ($fileMimeType !== 'application/pdf') {
	// 		$this->session->set_flashdata('error', 'Invalid file format. Please upload a PDF file.');
	// 		return false;
	// 	}
	// 	$uploadDir = './uploads/surat/';
	// 	$uploadPath = $uploadDir . $filename;
	// 	if (!move_uploaded_file($tmpname, $uploadPath)) {
	// 		$this->session->set_flashdata('error', 'Surat gagal disimpan');
	// 		return false;
	// 	}
	// 	return true;
	// }

	private function createFile($files, $filename)
{
    $config['upload_path']   = './uploads/surat/';
    $config['allowed_types'] = 'pdf';
    $config['file_name']     = $filename;
    $config['overwrite']     = true;

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload($files)) {
        $this->session->set_flashdata('error', $this->upload->display_errors());
        return false;
    }

    // Check if the uploaded file is a PDF
    $uploadedData = $this->upload->data();
    $fileMimeType = $uploadedData['file_type'];
    if ($fileMimeType !== 'application/pdf') {
        // Delete the incorrectly uploaded file
        unlink($uploadedData['full_path']);

        $this->session->set_flashdata('error', 'Invalid file format. Please upload a PDF file.');
        return false;
    }

    return true;
}
	 
	function list()
	{
		switch ($this->input->method()) {
			case 'get':
				$suratData = $this->msurat->getSuratByOwner($this->session->userdata('id'));

				$data['title'] = 'Daftar Surat';
				$data['suratData'] = $suratData;

				$this->load->view('partials_template/header', $data);
				$this->load->view('partials_template/sidebar_template');
				$this->load->view('partials_template/navbar_template');
				$this->load->view('surat/list', $data);
				$this->load->view('partials_template/footer');

				break;
			case 'post':
				$jenisSuratId = $this->input->post('jenisSuratId');
				$files = $_FILES['surat'];
				$title = pathinfo($files['name'])['filename'];
				$deskripsi = $this->input->post('deskripsi');
				$keperluan = $this->input->post('keperluan');
				$filename = $this->generateRandomPdfFilename();
				if (!$this->createFile('surat', $filename)) {
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

				$data['title'] = 'Edit Surat';
				$data['surat'] = $surat;
				$data['jenisSurat'] = $jenisSurat;

				$this->load->view('partials_template/header', $data);
				$this->load->view('partials_template/sidebar_template');
				$this->load->view('partials_template/navbar_template');
				$this->load->view('surat/edit', $data);
				$this->load->view('partials_template/footer');

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
					if (!$this->createFile('surat', $filename)) {
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
