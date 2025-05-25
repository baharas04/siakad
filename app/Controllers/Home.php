<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{
    protected $db;

    protected $helpers = ['form'];

    public function __construct() 
    {
        $this->db = db_connect();
    }
    public function index()
    {
        if ($this->request->getMethod() === 'post') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $session = session();
            $query = $this->db->table('pengguna')->where('email', $email)->where('password', $password)->get();
            $cek = count($query->getResult());
            $user = $query->getRow();
            if ($cek >= 1) {
                $session->set('idpengguna', $user->idpengguna);
                $session->set('nama', $user->nama);
                $session->set('email', $user->email);
                $session->set('nohp', $user->nohp);
                $session->set('level', $user->level);
                $session->setFlashdata('success', 'Login Berhasil');
                return redirect()->to('/panel/dashboard');
            } else {
                $session->setFlashdata('error', 'Login Gagal. Silakan cek kembali email dan password Anda.');
                return redirect()->to('/home');
            }
        } else {
            $data['title'] = 'Login';
            return view('auth/login', $data);
        }
    }
}
