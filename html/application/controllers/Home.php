<?php

Class Home extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('martikel');
        $this->load->model('mpengurus');
        $this->load->model('mpenduduk');
    }

    public function index()
    {
        $data['title'] = "Home"; 
        $data['artikel'] = $this->martikel->getAllArtikel(6);
				$data['pengurus'] = $this->mpengurus->getAllPengurusWithDetails();
        $this->load->view('partials_template/header', $data);
        $this->load->view('partials_template/navbar_public');
        $this->load->view('home/home', $data);
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

	public function listArtikel()
	{
		$data['title'] = 'Artikel';
		$data['artikel'] = $this->martikel->getAllArtikel();

		$this->load->view('partials_template/header', $data);
		$this->load->view('partials_template/navbar_public');
		$this->load->view('home/list_artikel', $data); 
		$this->load->view('partials_template/footer');
	}

	public function dataPengurus()
	{
		$data['title'] = 'Aparatur Desa';
		$data['pengurus'] = $this->mpengurus->getAllPengurusWithDetails();

		$this->load->view('partials_template/header', $data);
		$this->load->view('partials_template/navbar_public');
		$this->load->view('home/data_pengurus', $data); 
		$this->load->view('partials_template/footer');
	}

	public function dataPenduduk()
	{
		$data['title'] = 'Data Penduduk';
		$data['pengurus'] = $this->mpengurus->getAllPengurusWithDetails();

		$this->load->view('partials_template/header', $data);
		$this->load->view('partials_template/navbar_public');
		$this->load->view('home/data_penduduk', $data); 
		$this->load->view('partials_template/footer');
	}

	public function chartPendidikan()
	{
		$data = [
			'SD'=> $this->mpenduduk->getPendudukWhere(['pendidikan_id' => 1])->num_rows(),
			'SMP'=> $this->mpenduduk->getPendudukWhere(['pendidikan_id' => 2])->num_rows(),
			'SMA'=> $this->mpenduduk->getPendudukWhere(['pendidikan_id' => 3])->num_rows(),
			'S1'=> $this->mpenduduk->getPendudukWhere(['pendidikan_id' => 4])->num_rows()
		];
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function chartJK()
	{
		$data = [
			'Laki-laki'=> $this->mpenduduk->getPendudukWhere(['jenis_kelamin' => 'Laki-laki'])->num_rows(),
			'Perempuan'=> $this->mpenduduk->getPendudukWhere(['jenis_kelamin' => 'Perempuan'])->num_rows()
		];
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function chartPekerjaan()
	{
		$data = [
			'-'=> $this->mpenduduk->getPendudukWhere(['pekerjaan_id' => 1])->num_rows(),
			'PNS'=> $this->mpenduduk->getPendudukWhere(['pekerjaan_id' => 2])->num_rows(),
			'Swasta'=>$this->mpenduduk->getPendudukWhere(['pekerjaan_id' => 3])->num_rows(),
		];

		header('Content-Type: application/json');
		echo json_encode($data);
	}

}