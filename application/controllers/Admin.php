<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}
	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['makanan'] = $this->db->query("SELECT SUM(terjual) as maktot FROM menu WHERE id_kategori='1'")->row();
		$data['minuman'] = $this->db->query("SELECT SUM(terjual) as mintot FROM menu WHERE id_kategori='2'")->row();
		$data['pendapatan'] = $this->db->query("SELECT SUM(total_harga) as sumtot FROM transaksi WHERE status='1'")->row();
		$data['kategori'] = $this->db->get('kategori')->num_rows();

		$this->load->view("templates/header", $data);
		$this->load->view("templates/sidebar", $data);
		$this->load->view("admin/index", $data);
		$this->load->view("templates/footer");
	}
	public function menu()
	{
		$data['title'] = 'Menu';
		$this->db->select('*');
		$this->db->from('menu');
		$this->db->join('kategori', 'menu.id_kategori = kategori.id_kategori');
		$data['menu'] = $this->db->get()->result();
		$this->form_validation->set_rules('nama', 'Keyword', 'required|trim');
		$this->form_validation->set_rules('harga', 'Keyword', 'required|trim');
		$this->form_validation->set_rules('stok', 'Keyword', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view("templates/header", $data);
			$this->load->view("templates/sidebar", $data);
			$this->load->view("admin/menu", $data);
			$this->load->view("templates/footer");
		} else {
			$idmenu = '200502';
			$data['title'] = 'Transaksi';
			$sql = "SELECT MAX(MID(kd_menu,9,4)) AS kd_menu
			FROM menu
			WHERE MID(kd_menu,3,6) = '$idmenu'";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$row = $query->row();
				$n = ((int) $row->kd_menu) + 1;
				$no = sprintf("%'.04d", $n);
			} else {
				$no = "0001";
			}
			$kd_menu = "MN" . $idmenu . $no;
			$nama_menu = $this->input->post('nama');
			//proses input data disini
			$upload_image = $_FILES['image']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '2048';
				$config['upload_path'] = './dist/assets/static/images/makanan/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {
					$gambar = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}
			$data = [
				'kd_menu' => $kd_menu,
				'nama_menu' => $this->input->post('nama'),
				'id_kategori' => $this->input->post('kategori'),
				'harga' => $this->input->post('harga'),
				'stok' => $this->input->post('stok'),
				'gambar' => $gambar,
			];
			$this->db->insert('menu', $data);
			$this->session->set_flashdata('toast', "Toast.fire({icon: 'success', title: 'Menu $nama_menu Berhasil ditambahkan'});");
			redirect('admin/menu');
		}
	}
	public function menu_edit($id)
	{
		$data['title'] = 'Edit Menu';
		$data['title'] = 'Menu';
		$this->db->select('*');
		$this->db->from('menu');
		$this->db->join('kategori', 'menu.id_kategori = kategori.id_kategori');
		$this->db->where(['id_menu' => $id]);
		$data['menu'] = $this->db->get()->row();
		$this->form_validation->set_rules('nama', 'Keyword', 'required|trim');
		$this->form_validation->set_rules('harga', 'Keyword', 'required|trim');
		$this->form_validation->set_rules('stok', 'Keyword', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view("templates/header", $data);
			$this->load->view("templates/sidebar", $data);
			$this->load->view("admin/menu_edit", $data);
			$this->load->view("templates/footer");
		} else {
			$idmenu = '200502';
			$data['title'] = 'Transaksi';
			$sql = "SELECT MAX(MID(kd_menu,9,4)) AS kd_menu
			FROM menu
			WHERE MID(kd_menu,3,6) = '$idmenu'";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$row = $query->row();
				$n = ((int) $row->kd_menu) + 1;
				$no = sprintf("%'.04d", $n);
			} else {
				$no = "0001";
			}
			$kd_menu = "MN" . $idmenu . $no;
			$nama_menu = $this->input->post('nama');
			//proses input data disini
			$upload_image = $_FILES['image']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '2048';
				$config['upload_path'] = './dist/assets/static/images/makanan/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {
					unlink(FCPATH . '/dist/assets/static/images/makanan/' . $data['menu']->gambar);
					$gambar = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}
			if ($gambar) {
				$data = [
					'kd_menu' => $kd_menu,
					'nama_menu' => $this->input->post('nama'),
					'id_kategori' => $this->input->post('kategori'),
					'harga' => $this->input->post('harga'),
					'stok' => $this->input->post('stok'),
					'gambar' => $gambar
				];
			} else {
				$data = [
					'kd_menu' => $kd_menu,
					'nama_menu' => $this->input->post('nama'),
					'id_kategori' => $this->input->post('kategori'),
					'harga' => $this->input->post('harga'),
					'stok' => $this->input->post('stok'),
				];
			}
			$this->db->set($data);
			$this->db->where('id_menu', $id);
			$this->db->update('menu');
			$this->session->set_flashdata('toast', "Toast.fire({icon: 'success', title: 'Menu $nama_menu Berhasil diupdate'});");
			redirect('admin/menu');
		}
	}
	public function menu_hapus($id)
	{
		$img_post = $this->db->get_where('menu', ['id_menu' => $id])->row();
		unlink(FCPATH . '/dist/assets/static/images/makanan/' . $img_post->gambar);
		$this->db->delete('menu', ['id_menu' => $id]);
		$this->session->set_flashdata('toast', "Toast.fire({icon: 'success', title: 'Menu $img_post->nama_menu Berhasil dihapus'});");
		redirect('admin/menu');
	}
	public function kategori()
	{

		$data['title'] = 'Kategori';
		$data['kategori'] = $this->db->get('kategori')->result();
		$this->form_validation->set_rules('nama', 'Keyword', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view("templates/header", $data);
			$this->load->view("templates/sidebar", $data);
			$this->load->view("admin/kategori", $data);
			$this->load->view("templates/footer");
		} else {
			$nama_kategori = $this->input->post('nama');
			$data = [
				'nama_kategori' => $this->input->post('nama')
			];
			$this->db->insert('kategori', $data);
			$this->session->set_flashdata('toast', "Toast.fire({icon: 'success', title: 'Kategori $nama_kategori Berhasil ditambahkan'});");
			redirect('admin/kategori');
		}
	}
	public function kategori_edit($id)
	{
		$data['title'] = 'Edit kategori';
		$data['kategori'] = $this->db->get_where('kategori', ['id_kategori' => $id])->row();
		$this->form_validation->set_rules('nama', 'Keyword', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view("templates/header", $data);
			$this->load->view("templates/sidebar", $data);
			$this->load->view("admin/kategori_edit", $data);
			$this->load->view("templates/footer");
		} else {
			$nama_kategori = $this->input->post('nama');
			$data = [
				'nama_kategori' => $this->input->post('nama')
			];
			$this->db->set($data);
			$this->db->where('id_kategori', $id);
			$this->db->update('kategori');
			$this->session->set_flashdata('toast', "Toast.fire({icon: 'success', title: 'kategori $nama_kategori Berhasil diupdate'});");
			redirect('admin/kategori');
		}
	}
	public function kategori_hapus($id)
	{
		$img_post = $this->db->get_where('kategori', ['id_kategori' => $id])->row();
		$this->db->delete('kategori', ['id_kategori' => $id]);
		$this->session->set_flashdata('toast', "Toast.fire({icon: 'success', title: 'Kategori $img_post->nama_kategori Berhasil dihapus'});");
		redirect('admin/kategori');
	}
	function transaksi()
	{
		$data['title'] = 'Transaksi';
		$data['transaksi'] = $this->db->get('transaksi')->result();
		$this->load->view("templates/header", $data);
		$this->load->view("templates/sidebar", $data);
		$this->load->view("admin/transaksi", $data);
		$this->load->view("templates/footer");
	}
	public function tambah_transaksi()
	{
		$idtrans = '200502';
		$data['title'] = 'Transaksi';
		$sql = "SELECT MAX(MID(no_transaksi,9,4)) AS no_transaksi
		FROM transaksi
		WHERE MID(no_transaksi,3,6) = '$idtrans'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$row = $query->row();
			$n = ((int) $row->no_transaksi) + 1;
			$no = sprintf("%'.04d", $n);
		} else {
			$no = "0001";
		}
		$transaksi = "TR" . $idtrans . $no;
		$data['transaksi'] = $transaksi;
		$data['menu'] = $this->db->query("SELECT * FROM menu INNER JOIN kategori ON menu.id_kategori=kategori.id_kategori WHERE stok!='0'")->result();
		$data['transaksi_data'] = $this->db->query("SELECT * FROM detail_transaksi INNER JOIN menu ON detail_transaksi.id_menu=menu.id_menu WHERE no_transaksi='$transaksi'");
		$this->load->view("templates/header", $data);
		$this->load->view("templates/sidebar", $data);
		$this->load->view("admin/tambah_transaksi", $data);
		$this->load->view("templates/footer");
	}
	public function transaksi_data()
	{
		$idtrans = '200502';
		$data['title'] = 'Transaksi';
		$sql = "SELECT MAX(MID(no_transaksi,9,4)) AS no_transaksi
		FROM transaksi
		WHERE MID(no_transaksi,3,6) = '$idtrans'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$row = $query->row();
			$n = ((int) $row->no_transaksi) + 1;
			$no = sprintf("%'.04d", $n);
		} else {
			$no = "0001";
		}
		$transaksi = "TR" . $idtrans . $no;
		$data['transaksi_data'] = $this->db->query("SELECT * FROM detail_transaksi INNER JOIN menu ON detail_transaksi.id_menu=menu.id_menu WHERE no_transaksi='$transaksi'");
		$this->load->view('admin/transaksi_data', $data);
	}
	public function hapus_transaksi_data()
	{
		if (isset($_POST['batal_pembayaran'])) {
			$idtrans = $this->input->post('idTrans', true);
			$this->db->delete('detail_transaksi', ['no_transaksi' => "$idtrans"]);
		} else {
			$idtransaksi_data = $this->input->post('idtransaksi_data', true);
			$datum = $this->db->query("SELECT nama_menu FROM detail_transaksi INNER JOIN menu ON detail_transaksi.id_menu = menu.id_menu WHERE id_detailtransaksi = $idtransaksi_data")->row();
			$this->db->delete('detail_transaksi', ['id_detailtransaksi' => $idtransaksi_data]);
		}

		if ($this->db->affected_rows() > 0) {
			$params = ['success' => true, 'nama_menu' => $datum->nama_menu];
		} else {
			$params = ['success' => false];
		}
		echo json_encode($params);
	}
	public function updateStok()
	{
		$no = $this->input->post('no', true);
		$dele = $this->db->get_where('detail_transaksi', ['no_transaksi' => "$no"])->result_array();
		foreach ($dele as $del) {
			$data = $del['jumlah'];
			$id = $del['id_menu'];
			$this->db->query("UPDATE menu SET stok = stok - '$data' WHERE id_menu = '$id'");
			$this->db->query("UPDATE menu SET terjual = terjual + '$data' WHERE id_menu = '$id'");
		}
		if ($this->db->affected_rows() > 0) {
			$params = ['success' => true];
		} else {
			$params = ['success' => false];
		}
		echo json_encode($params);
	}
	public function reqPayment()
	{
		// Set your Merchant Server Key
		\Midtrans\Config::$serverKey = $_ENV['SERVER_KEY'];
		// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
		\Midtrans\Config::$isProduction = false; // Set sanitization on (default)
		\Midtrans\Config::$isSanitized = true;
		// Set 3DS transaction for credit card to true
		\Midtrans\Config::$is3ds = true;

		$no_transaksi = $this->input->post('no_transaksi', true);
		$tanggal = $this->input->post('tanggal', true);
		$metode = $this->input->post('metode', true);
		$nama_pem = $this->input->post('nama_pem', true);
		$total_harga = $this->input->post('total_harga', true);

		$data = [
			'no_transaksi' => $no_transaksi,
			'tanggal_transaksi' => $tanggal,
			'metode' => $metode,
			'total_harga' => $total_harga,
			'nama_pembeli' => $nama_pem,
		];
		// tambahkan data ke tabel detail_transaksi_penjualan
		$this->db->insert('transaksi', $data);
		if ($this->db->affected_rows() > 0) {
			$dataMenu = $this->db->query("SELECT * FROM detail_transaksi INNER JOIN menu ON detail_transaksi.id_menu=menu.id_menu WHERE no_transaksi='$no_transaksi'")->result();
			$paramsi = array(
				'transaction_details' => array(
					'order_id' => "$no_transaksi",
					'gross_amount' => $total_harga,
				),
				'item_details' => array(),
				'customer_details' => array(
					'first_name' => $nama_pem
				),
			);
			foreach ($dataMenu as $m) {

				$data =  array(
					"id" => $m->kd_menu,
					"price" => $m->harga,
					"quantity" => $m->jumlah,
					"name" => $m->nama_menu
				);
				$paramsi['item_details'][] = $data;
			}
			$snapToken = \Midtrans\Snap::getSnapToken($paramsi);
			$params = ['success' => true, 'token' => $snapToken];
		} else {
			$params = ['success' => false];
		}
		echo json_encode($params);
	}
	public function cetak_struk($no)
	{
		$data['transaksi'] = $this->db->get_where('transaksi', ['no_transaksi' => $no])->row();
		$data['menu'] = $this->db->query("SELECT * FROM detail_transaksi INNER JOIN menu ON detail_transaksi.id_menu=menu.id_menu WHERE no_transaksi='$no'")->result();
		$this->load->view("admin/cetak_struk", $data);
	}
	public function transaksi_proses()
	{
		if (isset($_POST['add_cart'])) {
			$id_menu = $this->input->post('id_menu', true);
			$jumlah = $this->input->post('jumlah', true);
			$no_transaksi = $this->input->post('no_transaksi', true);
			$cek_keranjang = $this->db->get_where('detail_transaksi', ['id_menu' => $id_menu, 'no_transaksi' => $no_transaksi])->num_rows();

			if ($cek_keranjang > 0) {
				$this->db->query("UPDATE detail_transaksi SET jumlah = jumlah + '$jumlah' WHERE id_menu = '$id_menu' AND no_transaksi = '$no_transaksi'");
			} else {
				$data = [
					'id_menu' => $id_menu,
					'jumlah' => $jumlah,
					'no_transaksi' => $no_transaksi
				];
				$this->db->insert('detail_transaksi', $data);
			}

			if ($this->db->affected_rows() > 0) {
				$params = ['success' => true];
			} else {
				$params = ['success' => false];
			}
			echo json_encode($params);
		}
		if (isset($_POST['edit_cart'])) {

			$data = [
				'jumlah' => $this->input->post('jumlah', true)
			];
			$id = $this->input->post('id', true);
			$id_menu = $this->input->post('id_menu', true);
			$this->db->set($data);
			$this->db->where('id_detailtransaksi', $id,);
			$this->db->where('id_menu', $id_menu,);
			$this->db->update('detail_transaksi');
			if ($this->db->affected_rows() > 0) {
				$params = ['success' => true];
			} else {
				$params = ['success' => false];
			}
			echo json_encode($params);
		}
		if (isset($_POST['save_token'])) {
			$data = [
				'token' => $this->input->post('token', true),
				'status' => '2'
			];
			$id = $this->input->post('no_transaksi', true);
			$this->db->set($data);
			$this->db->where('no_transaksi', $id,);
			$this->db->update('transaksi');
			if ($this->db->affected_rows() > 0) {
				$params = ['success' => true];
			} else {
				$params = ['success' => false];
			}
			echo json_encode($params);
		}
		if (isset($_POST['status_sukses'])) {
			$data = [
				'status' => '1'
			];
			$id = $this->input->post('no_transaksi', true);
			$this->db->set($data);
			$this->db->where('no_transaksi', $id,);
			$this->db->update('transaksi');
			if ($this->db->affected_rows() > 0) {
				$params = ['success' => true];
			} else {
				$params = ['success' => false];
			}
			echo json_encode($params);
		}
		if (isset($_POST['status_error'])) {
			$data = [
				'status' => '3'
			];
			$id = $this->input->post('no_transaksi', true);
			$this->db->set($data);
			$this->db->where('no_transaksi', $id,);
			$this->db->update('transaksi');
			if ($this->db->affected_rows() > 0) {
				$params = ['success' => true];
			} else {
				$params = ['success' => false];
			}
			echo json_encode($params);
		}
		if (isset($_POST['status_close'])) {
			$id = $this->input->post('no_transaksi', true);
			$this->db->delete('transaksi', ['no_transaksi' => $id]);
			if ($this->db->affected_rows() > 0) {
				$params = ['success' => true];
			} else {
				$params = ['success' => false];
			}
			echo json_encode($params);
		}
		// jika proses_pembayaran di tekan
		if (isset($_POST['proses_pembayaran'])) {
			$no_transaksi = $this->input->post('no_transaksi', true);
			$tanggal = $this->input->post('tanggal', true);
			$metode = $this->input->post('metode', true);
			$tunai = $this->input->post('tunai', true);
			$kembalian = $this->input->post('kembalian', true);
			$nama_pel = $this->input->post('nama_pel', true);
			$total_harga = $this->input->post('total_harga', true);

			$data = [
				'no_transaksi' => $no_transaksi,
				'tanggal_transaksi' => $tanggal,
				'metode' => $metode,
				'tunai' => $tunai,
				'kembalian' => $kembalian,
				'total_harga' => $total_harga,
				'nama_pembeli' => $nama_pel,
				'status' => 1
			];
			// tambahkan data ke tabel detail_transaksi_penjualan
			$this->db->insert('transaksi', $data);
			if ($this->db->affected_rows() > 0) {
				$params = ['success' => true, 'no' => $no_transaksi];
			} else {
				$params = ['success' => false];
			}
			echo json_encode($params);
		}
	}
	public function laporan()
	{
		$data['title'] = 'Laporan';
		$dari = $this->input->post('dari');
		$sampai = $this->input->post('sampai');
		$this->form_validation->set_rules('dari', 'Dari Tanggal', 'required');
		$this->form_validation->set_rules('sampai', 'Sampai Tanggal', 'required');

		if ($this->form_validation->run() != false) {
			$data['laporan'] = $this->db->query("select * from transaksi where date(tanggal_transaksi)>='$dari' and date(tanggal_transaksi)<='$sampai'")->result();
			$this->load->view("templates/header", $data);
			$this->load->view("templates/sidebar", $data);
			$this->load->view("admin/laporan_filter", $data);
			$this->load->view("templates/footer");
		} else {
			$this->load->view("templates/header", $data);
			$this->load->view("templates/sidebar", $data);
			$this->load->view("admin/laporan", $data);
			$this->load->view("templates/footer");
		}
	}
	public function laporan_print()
	{
		$this->load->library('pdf');
		$dari = $this->input->get('dari');
		$sampai = $this->input->get('sampai');

		if ($dari != "" && $sampai != "") {
			$data['laporan'] = $this->db->query("select * from transaksi where date(tanggal_transaksi)>='$dari' and date(tanggal_transaksi)<='$sampai'")->result();
			$data['judul'] = "Laporan " . $dari . " - " . $sampai;
			$this->pdf->set_option('isRemoteEnabled', TRUE);
			$this->pdf->setPaper('A4', 'potrait');
			$this->pdf->filename = "laporan-$dari-$sampai.pdf";
			$this->pdf->load_view('admin/laporan_print', $data);
		} else {
			redirect("admin/laporan");
		}
	}
}
