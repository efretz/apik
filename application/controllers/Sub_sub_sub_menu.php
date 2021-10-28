<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sub_sub_sub_menu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('System_sub_sub_sub_menu_model', 'sys_sub_sub_sub_menu_m');
    }

    public function index($menu_id = null, $sub_menu_id = null, $sub_sub_menu_id = null)
    {
        $data['menu_id'] = $menu_id;
        $data['sub_menu_id'] = $sub_menu_id;
        $data['sub_sub_menu_id'] = $sub_sub_menu_id;

        // setting halaman
        $config['base_url'] = base_url('sub-sub-sub-menu/index/' . $menu_id . '/' . $sub_menu_id . '/' . $sub_sub_menu_id . '');
        $config['total_rows'] = $this->sys_sub_sub_sub_menu_m->count($sub_sub_menu_id);
        $config['per_page'] = 10;
        $config["num_links"] = 3;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['page'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;
        $limit = $config["per_page"];
        $offset = $data['page'];

        // menangkap pencarian jika ada
        $name = $this->input->post('name');
        $data['name'] = $name;

        // pilih tampilan data, semua atau berdasarkan pencarian
        if ($name) {
            $data['sub_sub_sub_menu'] = $this->sys_sub_sub_sub_menu_m->find($name, $sub_menu_id, $sub_sub_menu_id);
        } else {
            $data['sub_sub_sub_menu'] = $this->sys_sub_sub_sub_menu_m->get($limit, $offset, $sub_menu_id, $sub_sub_menu_id);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('sub_sub_sub_menu/index', $data);
        $this->load->view('template/footer');
    }

    private $rules = [
        [
            'field' => 'name',
            'label' => 'Nama',
            'rules' => 'required|trim'
        ]
    ];

    public function create($menu_id = null, $sub_menu_id = null, $sub_sub_menu_id = null)
    {
        $data['menu_id'] = $menu_id;
        $data['sub_menu_id'] = $sub_menu_id;
        $data['sub_sub_menu_id'] = $sub_sub_menu_id;

        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'url' => htmlspecialchars($this->input->post('url', true)),
                'icon' => htmlspecialchars($this->input->post('icon', true)),
                'menu_id' => $menu_id,
                'sub_menu_id' => $sub_menu_id,
                'sub_sub_menu_id' => $sub_sub_menu_id
            ];
            $this->sys_sub_sub_sub_menu_m->create($data);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
            redirect('sub-sub-sub-menu/index/' . $menu_id . '/' . $sub_menu_id . '/' . $sub_sub_menu_id . '');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('sub_sub_sub_menu/create', $data);
        $this->load->view('template/footer');
    }

    public function update($id, $menu_id, $sub_menu_id = null, $sub_sub_menu_id = null)
    {
        if (!isset($id)) show_404();

        $data['menu_id'] = $menu_id;
        $data['sub_menu_id'] = $sub_menu_id;
        $data['sub_sub_menu_id'] = $sub_sub_menu_id;
        $data['sub_sub_sub_menu'] = $this->sys_sub_sub_sub_menu_m->getDetail($id);
        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'url' => htmlspecialchars($this->input->post('url', true)),
                'icon' => htmlspecialchars($this->input->post('icon', true)),
                'menu_id' => $menu_id,
                'sub_menu_id' => $sub_menu_id
            ];
            $this->sys_sub_sub_sub_menu_m->update($data, $id);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah.');
            redirect('sub-sub-sub-menu/index/' . $menu_id . '/' . $sub_menu_id . '/' . $sub_sub_menu_id . '');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('sub_sub_sub_menu/update', $data);
        $this->load->view('template/footer');
    }

    public function delete($id, $menu_id, $sub_menu_id = null, $sub_sub_menu_id = null)
    {
        if (!isset($id)) show_404();

        if ($this->sys_sub_sub_sub_menu_m->delete($id)) {
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('sub-sub-sub-menu/index/' . $menu_id . '/' . $sub_menu_id . '/' . $sub_sub_menu_id . '');
    }
}
