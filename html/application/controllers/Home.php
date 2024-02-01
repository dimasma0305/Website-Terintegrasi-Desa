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

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['artikel'] = $this->martikel->getAllArtikel(10, $page);
		
		$data['pagination_links'] = $this->_createPagination(base_url('home/listartikel'), $this->martikel->count(), 10);

		$this->load->view('partials_template/header', $data);
		$this->load->view('partials_template/navbar_public');
		$this->load->view('home/list_artikel', $data); 
		$this->load->view('partials_template/footer');
	}

	private function _createPagination($baseUrl, $totalRows, $perPage)
	{
		$this->load->library('pagination');
		$config['base_url'] = $baseUrl;
		$config['total_rows'] = $totalRows; // Replace with the total number of rows you have.
		$config['per_page'] = $perPage; // Number of records per page.

		$config['full_tag_open'] = '<ul class="pagination">';        
		$config['full_tag_close'] = '</ul>';        
		$config['first_link'] = 'First';        
		$config['last_link'] = 'Last';        
		$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';        
		$config['first_tag_close'] = '</span></li>';        
		$config['prev_link'] = '&laquo';        
		$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';        
		$config['prev_tag_close'] = '</span></li>';        
		$config['next_link'] = '&raquo';        
		$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';        
		$config['next_tag_close'] = '</span></li>';        
		$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';        
		$config['last_tag_close'] = '</span></li>';        
		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';        
		$config['cur_tag_close'] = '</a></li>';        
		$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';        
		$config['num_tag_close'] = '</span></li>';

		$this->pagination->initialize($config);

		return $this->pagination->create_links();
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