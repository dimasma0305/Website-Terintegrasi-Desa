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
        $data['artikel'] = $this->martikel->getAllArtikel(3);
		$data['pengurus'] = $this->mpengurus->getAllPengurusWithDetails();
        $this->load->view('partials_template/header', $data);
        $this->load->view('partials_template/navbar_public');
        $this->load->view('home/home', $data);
        $this->load->view('partials_template/footer');
    }

    public function artikel($slug='')
	{
		$artikel = $this->martikel->getArtikelWhere(['slug' => $slug])->row();

		if ($artikel) {
			$data['artikel'] = $artikel;
			$data['title'] = $artikel->title;

			$this->load->view('partials_template/header', $data);
			$this->load->view('partials_template/navbar_public');
			$this->load->view('home/detail', $data); 
			$this->load->view('partials_template/footer');
		} else {
			redirect('home/listartikel'); 
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

		$this->load->view('partials_template/header', $data);
		$this->load->view('partials_template/navbar_public');
		$this->load->view('home/data_penduduk', $data); 
		$this->load->view('partials_template/footer');
	}

	public function chart()
	{
		$data['pendidikan'] = [
			'SD'=> $this->mpenduduk->count(['pendidikan' => 'SD']),
			'SMP'=> $this->mpenduduk->count(['pendidikan' => 'SMP']),
			'SMA'=> $this->mpenduduk->count(['pendidikan' => 'SMA']),
			'S1'=> $this->mpenduduk->count(['pendidikan' => 'S1'])
		];

		$data['jenisKelamin'] = [
			'Laki-laki'=> $this->mpenduduk->count(['jenis_kelamin' => 'Laki-laki']),
			'Perempuan'=> $this->mpenduduk->count(['jenis_kelamin' => 'Perempuan'])
		];

		$data['pekerjaan'] = [
			'PNS' => $this->mpenduduk->count(['pekerjaan' => 'PNS']),
			'Swasta' => $this->mpenduduk->count(['pekerjaan' => 'Swasta']),
			'Belum Bekerja'=> $this->mpenduduk->count(['pekerjaan' => 'Belum Bekerja']),
			'Siswa'=> $this->mpenduduk->count(['pekerjaan' => 'Siswa']),
			'Mahasiswa'=> $this->mpenduduk->count(['pekerjaan' => 'Mahasiswa'])
		];

		header('Content-Type: application/json');
		echo json_encode($data);
	}
}