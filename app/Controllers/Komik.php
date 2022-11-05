<?php

namespace App\Controllers;

use App\Models\KomikModel;
use CodeIgniter\HTTP\Request;

class Komik extends BaseController
{
    protected $komikModel;
    public function __construct()
    {
        $this->komikModel = new KomikModel();
    }

    public function index(){
        // $komik = $this->komikModel->findAll();

        $data = [
            'title' => 'Komik | Lynx',
            'komik' => $this->komikModel->getKomik()
        ];

        // $komikModel = new \App\Models\KomikModel();

        return view('komik/index', $data);
    }

    public function detail($slug){
        $data = [
            'title' => 'Detail Komik | Lynx',
            'komik' => $this->komikModel->getKomik($slug)
        ];

        //jika komik tidka ada di tabel
        if(empty($data['komik'])){
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul komik ' . $slug . 'tidak ditemukan');
        }
        return view('komik/detail', $data);
    }

    public function create(){

        $data = [
            'title' => 'Tambah Komik | Lynx',
            'validation' => \Config\Services::validation()
        ];

        return view('komik/create', $data);
    }
    
    public function save(){

        //validasi input
        if(!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[komik.judul]',
                'errors' => [
                    'required' => '{field} komik harus diisi.',
                    'is_unique' => '{field} komik sudah ada.'
                ]
            ],
            'penulis' => 'required',
            'penerbit' => 'required',
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar!',
                    'is_image' => 'Mohon masukan gambar',
                    'mime_in' => 'Mohon masukan gambar'
                ]
            ]
        ])){
            // $validation = \Config\Services::validation();
            // return redirect()->to(base_url('/komik/create'))->withInput()->with('validation', $validation);
            return redirect()->to(base_url('/komik/create'))->withInput();
        }


        //ambil gambar
        $fileSampul = $this->request->getFile('sampul');

        //apakah tidak ada gambar diupload
        if($fileSampul->getError() == 4){
            $namaSampul = 'default.png';
        }else{

            // generate nama sampul
            $namaSampul = $fileSampul->getRandomName();
            
            //pindahkan file ke folder lmg/ $namaSampul diperlukan jika generate nama random sampul jika tidak tidak usah pake param 2
            $fileSampul->move('img', $namaSampul);
    
            // // ambil nama sampul
            // $namaSampul = $fileSampul->getName();
        }



        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->komikModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        
        return redirect()->to(base_url('/komik'));
    }
    
    public function delete($id){
        //cari gamabr berdasar id
        $komik = $this->komikModel->find($id);

        // cek jika file default
        if($komik['sampul'] != 'default.png'){
            //hapus gambar
            unlink('img/' . $komik['sampul']);
        }


        $this->komikModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to(base_url('/komik'));
    }

    public function edit($slug){
        $data = [
            'title' => 'Edit Komik | Lynx',
            'validation' => \Config\Services::validation(),
            'komik' => $this->komikModel->getKomik($slug)
        ];

        return view('komik/edit', $data);
    }

    public function update($id){
        //cek judul
        $komikLama = $this->komikModel->getKomik($this->request->getVar('slug'));
        if($komikLama['judul'] == $this->request->getVar('judul')){
            $rule_judul = 'required';
        }else{
            $rule_judul = 'required|is_unique[komik.judul]';
        }

        if(!$this->validate([
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} komik harus diisi.',
                    'is_unique' => '{field} komik sudah ada.'
                ]
            ],
            'penulis' => 'required',
            'penerbit' => 'required',
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar!',
                    'is_image' => 'Mohon masukan gambar',
                    'mime_in' => 'Mohon masukan gambar'
                ]
            ]
        ])){
            return redirect()->to(base_url('/komik/edit/' . $this->request->getVar('slug')))->withInput();
        }

        $fileSampul = $this->request->getFile('sampul');

        //cek gambar apakah berubah atau tidak
        if($fileSampul->getError() == 4){
            $namaSampul = $this->request->getVar('sampulLama');
        }else{
            //generate nama file random
            $namaSampul = $fileSampul->getRandomName();
            $fileSampul->move('img', $namaSampul);

            //jika sampul adlh default
            if($this->request->getVar('sampulLama') != 'default.png'){
                //hapus file lama
                unlink('img/' . $this->request->getVar('sampulLama'));
            }
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->komikModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        
        return redirect()->to(base_url('/komik'));
    }
}
