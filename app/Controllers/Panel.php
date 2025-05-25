<?php

namespace App\Controllers;

use PDO;
use App\Controllers\BaseController;
use CodeIgniter\Database\ConnectionInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

date_default_timezone_set('Asia/Jakarta');
class Panel extends BaseController
{

    protected $db;

    public function dashboard()
    {
        $id = session('idpengguna');
        if (session('level') == 'Admin' or session('level') == 'Pimpinan') {
            $jumlahkelas = count($this->db->table('kelas')->get()->getResult());
            $jumlahmatapelajaran = count($this->db->table('matapelajaran')->get()->getResult());
            $jumlahsiswa = count($this->db->table('siswa')->get()->getResult());
            $jumlahguru = count($this->db->table('guru')->get()->getResult());
            $jumlahujian = count($this->db->table('kuis')->get()->getResult());
            $data = [
                'title' => 'Admin',
                'jumlahkelas' => $jumlahkelas,
                'jumlahmatapelajaran' => $jumlahmatapelajaran,
                'jumlahsiswa' => $jumlahsiswa,
                'jumlahguru' => $jumlahguru,
                'jumlahujian' => $jumlahujian,
            ];
        }
        if (session('level') == 'Guru') {
            $jumlahkelas = count($this->db->table('kelas')->get()->getResult());
            $jumlahsiswa = count($this->db->table('siswa')->get()->getResult());
            $jumlahujian = count($this->db->table('kuis')->where('idguru_pengguna', $id)->get()->getResult());
            $data = [
                'title' => 'Admin',
                'jumlahkelas' => $jumlahkelas,
                'jumlahsiswa' => $jumlahsiswa,
                'jumlahujian' => $jumlahujian,
            ];
        }
        if (session('level') == 'Siswa') {
            $siswa = $this->db->table('siswa')->where('idpengguna', $id)->get()->getRow();
            $idkelas = $siswa->idkelas;
            $jumlahkelas = count($this->db->table('kelas')->get()->getResult());
            $jumlahsiswa = count($this->db->table('siswa')->get()->getResult());
            $jumlahujian = count($this->db->table('kuis')->where('idkelas', $idkelas)->get()->getResult());

            $tahun = $this->request->getGet('tahun') ?? date('Y'); // Ambil tahun dari query string

            // Ambil jumlah prestasi per bulan untuk tahun yang dipilih
            $prestasi_per_bulan = [];
            for ($bulan = 1; $bulan <= 12; $bulan++) {
                $prestasi_per_bulan[] = $this->db->table('prestasi')
                    ->where('YEAR(tanggal)', $tahun)
                    ->where('MONTH(tanggal)', $bulan)
                    ->countAllResults();
            }


            // Ambil data pengumuman dan prestasi
            $pengumuman = $this->db->table('pengumuman')->orderBy('idpengumuman', 'DESC')->get()->getResult();
            $prestasi = $this->db->table('prestasi')->orderBy('idprestasi', 'DESC')->get()->getResult();

            $data = [
                'title' => 'Admin',
                'jumlahujian' => $jumlahujian,
                'pengumuman' => $pengumuman,
                'prestasi' => $prestasi,
                'prestasi_per_bulan' => $prestasi_per_bulan,
                'tahun' => $tahun,
            ];
        }
        return view('panel/dashboard', $data);
    }

    protected $helpers = ['form', 'fungsi'];

    public function __construct()
    {
        $this->db = db_connect();
    }

    public function penggunatambah()
    {
        if ($this->request->getMethod() === 'post') {
            $simpan = [
                'nama' => $this->request->getPost('nama'),
                'email' => $this->request->getPost('email'),
                'nohp' => $this->request->getPost('nohp'),
                'password' => $this->request->getPost('password'),
                'level' => $this->request->getPost('level'),
            ];
            $this->db->table('pengguna')->insert($simpan);
            session()->setFlashdata('success', 'Data berhasil disimpan.');
            return redirect()->to('/panel/penggunadaftar');
        } else {
            $data = [
                'title' => 'Tambah Pengguna',
            ];
            return view('panel/penggunatambah', $data);
        }
    }

    public function penggunaedit($id)
    {
        if ($this->request->getMethod() === 'post') {
            $simpan = [
                'nama' => $this->request->getPost('nama'),
                'email' => $this->request->getPost('email'),
                'nohp' => $this->request->getPost('nohp'),
                'password' => $this->request->getPost('password'),
                'level' => $this->request->getPost('level'),
            ];
            $this->db->table('pengguna')->where('idpengguna', $id)->update($simpan);
            session()->setFlashdata('success', 'Data berhasil disimpan.');
            return redirect()->to('/panel/penggunadaftar');
        } else {
            $data = [
                'title' => 'Edit Pengguna',
                'id' => $id,
                'row' => $this->db->table('pengguna')->where('idpengguna', $id)->get()->getRow()

            ];
            return view('panel/penggunaedit', $data);
        }
    }

    public function penggunadaftar()
    {
        $data = [
            'title' => 'Daftar Pengguna',
            'pengguna' => $this->db->table('pengguna')->where('level', 'Admin')->orWhere('level', 'Pimpinan')->get()->getResult()

        ];
        return view('panel/penggunadaftar', $data);
    }

    public function penggunahapus($id)
    {
        $this->db->table('pengguna')->where('idpengguna', $id)->delete();
        session()->setFlashdata('success', 'Data berhasil disimpan.');
        return redirect()->to('/panel/penggunadaftar');
    }

    public function kelastambah()
    {
        if ($this->request->getMethod() === 'post') {
            $simpan = [
                'kelas' => $this->request->getPost('kelas'),
            ];
            $this->db->table('kelas')->insert($simpan);
            session()->setFlashdata('success', 'Data berhasil disimpan.');
            return redirect()->to('/panel/kelasdaftar');
        } else {
            $data = [
                'title' => 'Tambah Kelas',
            ];
            return view('panel/kelastambah', $data);
        }
    }

    public function kelasedit($id)
    {
        if ($this->request->getMethod() === 'post') {
            $simpan = [
                'kelas' => $this->request->getPost('kelas'),
            ];
            $this->db->table('kelas')->where('idkelas', $id)->update($simpan);
            session()->setFlashdata('success', 'Data berhasil disimpan.');
            return redirect()->to('/panel/kelasdaftar');
        } else {
            $data = [
                'title' => 'Edit Kelas',
                'id' => $id,
                'row' => $this->db->table('kelas')->where('idkelas', $id)->get()->getRow()

            ];
            return view('panel/kelasedit', $data);
        }
    }

    public function kelasdaftar()
    {
        $data = [
            'title' => 'Daftar Kelas',
            'kelas' => $this->db->table('kelas')->get()->getResult()
        ];
        return view('panel/kelasdaftar', $data);
    }

    public function kelashapus($id)
    {
        $this->db->table('kelas')->where('idkelas', $id)->delete();
        session()->setFlashdata('success', 'Data berhasil disimpan.');
        return redirect()->to('/panel/kelasdaftar');
    }

    public function matapelajarantambah()
    {
        if ($this->request->getMethod() === 'post') {
            $simpan = [
                'matapelajaran' => $this->request->getPost('matapelajaran'),
            ];
            $this->db->table('matapelajaran')->insert($simpan);
            session()->setFlashdata('success', 'Data berhasil disimpan.');
            return redirect()->to('/panel/matapelajarandaftar');
        } else {
            $data = [
                'title' => 'Tambah Mata Pelajaran',
            ];
            return view('panel/matapelajarantambah', $data);
        }
    }

    public function matapelajaranedit($id)
    {
        if ($this->request->getMethod() === 'post') {
            $simpan = [
                'matapelajaran' => $this->request->getPost('matapelajaran'),
            ];
            $this->db->table('matapelajaran')->where('idmatapelajaran', $id)->update($simpan);
            session()->setFlashdata('success', 'Data berhasil disimpan.');
            return redirect()->to('/panel/matapelajarandaftar');
        } else {
            $data = [
                'title' => 'Edit Mata Pelajaran',
                'id' => $id,
                'row' => $this->db->table('matapelajaran')->where('idmatapelajaran', $id)->get()->getRow()

            ];
            return view('panel/matapelajaranedit', $data);
        }
    }

    public function matapelajarandaftar()
    {
        $data = [
            'title' => 'Daftar Mata Pelajaran',
            'matapelajaran' => $this->db->table('matapelajaran')->get()->getResult()
        ];
        return view('panel/matapelajarandaftar', $data);
    }

    public function matapelajaranhapus($id)
    {
        $this->db->table('matapelajaran')->where('idmatapelajaran', $id)->delete();
        session()->setFlashdata('success', 'Data berhasil disimpan.');
        return redirect()->to('/panel/matapelajarandaftar');
    }

    public function siswatambah()
    {
        if ($this->request->getMethod() === 'post') {
            $simpan = [
                'nama' => $this->request->getPost('nama'),
                'email' => $this->request->getPost('email'),
                'nohp' => $this->request->getPost('nohp'),
                'password' => $this->request->getPost('password'),
                'level' => "Siswa",
            ];
            $this->db->table('pengguna')->insert($simpan);
            $idpengguna = $this->db->insertID();
            $simpansiswa = [
                'idpengguna' => $idpengguna,
                'nis' => $this->request->getPost('nis'),
                'idkelas' => $this->request->getPost('idkelas'),
            ];
            $this->db->table('siswa')->insert($simpansiswa);
            session()->setFlashdata('success', 'Data berhasil disimpan.');
            return redirect()->to('/panel/siswadaftar');
        } else {
            $data = [
                'title' => 'Tambah Siswa',
                'kelas' => $this->db->table('kelas')->get()->getResult()
            ];
            return view('panel/siswatambah', $data);
        }
    }

    public function siswaedit($id)
    {
        $siswa = $this->db->table('siswa')->where('idsiswa', $id)->get()->getRow();
        if ($this->request->getMethod() === 'post') {
            $simpan = [
                'nama' => $this->request->getPost('nama'),
                'email' => $this->request->getPost('email'),
                'nohp' => $this->request->getPost('nohp'),
                'password' => $this->request->getPost('password'),
            ];
            $this->db->table('pengguna')->where('idpengguna', $siswa->idpengguna)->update($simpan);
            $simpansiswa = [
                'nis' => $this->request->getPost('nis'),
                'idkelas' => $this->request->getPost('idkelas'),
            ];
            $this->db->table('siswa')->where('idsiswa', $id)->update($simpansiswa);
            session()->setFlashdata('success', 'Data berhasil disimpan.');
            return redirect()->to('/panel/siswadaftar');
        } else {
            $data = [
                'title' => 'Edit Siswa',
                'kelas' => $this->db->table('kelas')->get()->getResult(),
                'id' => $id,
                'row' => $this->db->table('siswa')->join('pengguna', 'siswa.idpengguna = pengguna.idpengguna')->where('siswa.idsiswa', $id)->get()->getRow()

            ];
            return view('panel/siswaedit', $data);
        }
    }

    public function siswadaftar()
    {
        if ($this->request->getPost('idkelas') != '') {
            $idkelas = $this->request->getPost('idkelas');
            $data = [
                'title' => 'Daftar Siswa',
                'siswa' => $this->db->table('pengguna')->where('siswa.idkelas', $idkelas)->join('siswa', 'pengguna.idpengguna = siswa.idpengguna')->join('kelas', 'siswa.idkelas = kelas.idkelas')->where('level', 'Siswa')->get()->getResult(),
                'kelas' => $this->db->table('kelas')->get()->getResult(),
                'idkelas' => $idkelas
            ];
        } else {
            $idkelas = "Semua";
            $data = [
                'title' => 'Daftar Siswa',
                'siswa' => $this->db->table('pengguna')->join('siswa', 'pengguna.idpengguna = siswa.idpengguna')->join('kelas', 'siswa.idkelas = kelas.idkelas')->where('level', 'Siswa')->get()->getResult(),
                'kelas' => $this->db->table('kelas')->get()->getResult(),
                'idkelas' => $idkelas
            ];
        }
        return view('panel/siswadaftar', $data);
    }

    public function siswahapus($id)
    {
        $siswa = $this->db->table('siswa')->where('idsiswa', $id)->get()->getRow();
        $this->db->table('pengguna')->where('idpengguna', $siswa->idpengguna)->delete();
        $this->db->table('siswa')->where('idsiswa', $id)->delete();
        session()->setFlashdata('success', 'Data berhasil disimpan.');
        return redirect()->to('/panel/siswadaftar');
    }

    public function gurutambah()
    {
        if ($this->request->getMethod() === 'post') {
            $simpan = [
                'nama' => $this->request->getPost('nama'),
                'email' => $this->request->getPost('email'),
                'nohp' => $this->request->getPost('nohp'),
                'password' => $this->request->getPost('password'),
                'level' => "Guru",
            ];
            $this->db->table('pengguna')->insert($simpan);
            $idpengguna = $this->db->insertID();
            $simpanguru = [
                'idpengguna' => $idpengguna,
                'nip' => $this->request->getPost('nip'),
            ];
            $this->db->table('guru')->insert($simpanguru);
            session()->setFlashdata('success', 'Data berhasil disimpan.');
            return redirect()->to('/panel/gurudaftar');
        } else {
            $data = [
                'title' => 'Tambah Guru',
            ];
            return view('panel/gurutambah', $data);
        }
    }

    public function guruedit($id)
    {
        $guru = $this->db->table('guru')->where('idguru', $id)->get()->getRow();
        if ($this->request->getMethod() === 'post') {
            $simpan = [
                'nama' => $this->request->getPost('nama'),
                'email' => $this->request->getPost('email'),
                'nohp' => $this->request->getPost('nohp'),
                'password' => $this->request->getPost('password'),
            ];
            $this->db->table('pengguna')->where('idpengguna', $guru->idpengguna)->update($simpan);
            $simpanguru = [
                'nip' => $this->request->getPost('nip'),
            ];
            $this->db->table('guru')->where('idguru', $id)->update($simpanguru);
            session()->setFlashdata('success', 'Data berhasil disimpan.');
            return redirect()->to('/panel/gurudaftar');
        } else {
            $data = [
                'title' => 'Edit Guru',
                'id' => $id,
                'row' => $this->db->table('guru')->join('pengguna', 'guru.idpengguna = pengguna.idpengguna')->where('guru.idguru', $id)->get()->getRow()

            ];
            return view('panel/guruedit', $data);
        }
    }

    public function gurudaftar()
    {
        $data = [
            'title' => 'Daftar Guru',
            'guru' => $this->db->table('pengguna')->join('guru', 'pengguna.idpengguna = guru.idpengguna')->where('level', 'Guru')->get()->getResult()

        ];
        return view('panel/gurudaftar', $data);
    }

    public function guruhapus($id)
    {
        $guru = $this->db->table('guru')->where('idguru', $id)->get()->getRow();
        $this->db->table('pengguna')->where('idpengguna', $guru->idpengguna)->delete();
        $this->db->table('guru')->where('idguru', $id)->delete();
        session()->setFlashdata('success', 'Data berhasil disimpan.');
        return redirect()->to('/panel/gurudaftar');
    }

    public function profiledit()
    {
        $idpengguna = session('idpengguna');
        if ($this->request->getMethod() === 'post') {
            $simpan = [
                'nama' => $this->request->getPost('nama'),
                'email' => $this->request->getPost('email'),
                'nohp' => $this->request->getPost('nohp'),
                'password' => $this->request->getPost('password'),
            ];
            $this->db->table('pengguna')->where('idpengguna', $idpengguna)->update($simpan);
            $session = session();
            $session->set('nama', $this->request->getPost('nama'));
            $session->set('email', $this->request->getPost('email'));
            $session->set('nohp', $this->request->getPost('nohp'));
            session()->setFlashdata('success', 'Data berhasil disimpan.');
            return redirect()->to('/panel/profiledit');
        } else {
            $data = [
                'title' => 'Edit Profil',
                'id' => $idpengguna,
                'row' => $this->db->table('pengguna')->where('idpengguna', $idpengguna)->get()->getRow()

            ];
            return view('panel/profiledit', $data);
        }
    }

    public function logout()
    {
        session()->destroy();
        session()->setFlashdata('success', 'Logout Berhasil.');
        return redirect()->to('/home');
    }

    public function ujiandaftar()
    {
        $id = session()->get('idpengguna');
        $level = session()->get('level');
        $kuis = [];
        if ($level == 'Admin' or $level == 'Pimpinan') {
            $data = [
                'title' => 'Daftar Ujian',
                'ujian' => $this->db->table('kuis')->join('pengguna', 'kuis.idguru_pengguna = pengguna.idpengguna')->join('kelas', 'kelas.idkelas = kuis.idkelas')->orderBy('waktumulai', 'desc')->get()->getResult(),
                'kuis' => $kuis
            ];
        }
        if ($level == 'Guru') {
            $data = [
                'title' => 'Daftar Ujian',
                'ujian' => $this->db->table('kuis')->where('idguru_pengguna', $id)->join('pengguna', 'kuis.idguru_pengguna = pengguna.idpengguna')->where('idguru_pengguna', $id)->join('kelas', 'kelas.idkelas = kuis.idkelas')->orderBy('waktumulai', 'desc')->get()->getResult(),
                'kuis' => $kuis
            ];
        }
        if ($level == 'Siswa') {
            $siswa = $this->db->table('siswa')->where('idpengguna', $id)->get()->getRow();
            $idkelas = $siswa->idkelas;
            $kuis = $this->db->table('kuis')->where('idkelas', $idkelas)->orderBy('waktumulai', 'desc')->get()->getResult();
            $data = [
                'title' => 'Daftar Ujian',
                'ujian' => $this->db->table('kuis')->join('pengguna', 'kuis.idguru_pengguna = pengguna.idpengguna')->where('idguru_pengguna', $id)->join('kelas', 'kelas.idkelas = kuis.idkelas')->orderBy('waktumulai', 'desc')->get()->getResult(),
                'kuis' => $kuis
            ];
        }
        return view('panel/ujiandaftar', $data);
    }

    public function ujiantambah()
    {
        if ($this->request->getMethod() === 'post') {
            $simpan = [
                'judul' => $this->request->getPost('judul'),
                'matapelajaran' => $this->request->getPost('matapelajaran'),
                'idkelas' => $this->request->getPost('kelas'),
                'idguru_pengguna' => $this->request->getPost('idguru_pengguna'),
                'waktumulai' => $this->request->getPost('waktumulai'),
                'waktuakhir' => $this->request->getPost('waktuakhir'),
                'isi' => $this->request->getPost('isi'),
            ];
            $this->db->table('kuis')->insert($simpan);
            session()->setFlashdata('success', 'Data berhasil disimpan.');
            return redirect()->to('/panel/ujiandaftar');
        } else {
            $data = [
                'title' => 'Tambah Ujian',
                'kelas' => $this->db->table('kelas')->orderBy('kelas', 'asc')->get()->getResult(),
                'matapelajaran' => $this->db->table('matapelajaran')->get()->getResult(),
                'guru' => $this->db->table('pengguna')->where('level', 'Guru')->get()->getResult(),
            ];
            return view('panel/ujiantambah', $data);
        }
    }

    public function ujianedit($id)
    {
        $kuis = $this->db->table('kuis')->where('idkuis', $id)->get()->getRow();
        if ($this->request->getMethod() === 'post') {
            $simpan = [
                'judul' => $this->request->getPost('judul'),
                'matapelajaran' => $this->request->getPost('matapelajaran'),
                'idkelas' => $this->request->getPost('kelas'),
                'idguru_pengguna' => $this->request->getPost('idguru_pengguna'),
                'isi' => $this->request->getPost('isi'),
                'waktumulai' => $this->request->getPost('waktumulai'),
                'waktuakhir' => $this->request->getPost('waktuakhir'),
            ];
            $this->db->table('kuis')->where('idkuis', $kuis->idkuis)->update($simpan);
            session()->setFlashdata('success', 'Data berhasil diubah.');
            return redirect()->to('/panel/ujiandaftar');
        } else {
            $data = [
                'title' => 'Edit Ujian',
                'kelas' => $this->db->table('kelas')->orderBy('kelas', 'asc')->get()->getResult(),
                'id' => $id,
                'row' => $this->db->table('kuis')->where('idkuis', $id)->get()->getRow(),
                'soal' => $this->db->table('soal')->where('idkuis', $id)->get()->getResult(),
                'matapelajaran' => $this->db->table('matapelajaran')->get()->getResult(),
                'guru' => $this->db->table('pengguna')->where('level', 'Guru')->get()->getResult(),
            ];
            return view('panel/ujianedit', $data);
        }
    }

    public function ujianhapus($id)
    {
        $this->db->table('kuis')->where('idkuis', $id)->delete();
        session()->setFlashdata('success', 'Data berhasil dihapus.');
        return redirect()->to('/panel/ujiandaftar');
    }

    public function soaltambah($id)
    {
        if ($this->request->getMethod() === 'post') {
            $simpan = [
                'idkuis' => $id,
                'soal' => $this->request->getPost('soal'),
                'a' => $this->request->getPost('a'),
                'b' => $this->request->getPost('b'),
                'c' => $this->request->getPost('c'),
                'd' => $this->request->getPost('d'),
                'kunci' => $this->request->getPost('kunci'),
                'bobot' => $this->request->getPost('bobot'),
            ];
            $this->db->table('soal')->insert($simpan);

            session()->setFlashdata('success', 'Data berhasil disimpan.');
            return redirect()->to('/panel/ujianedit/' . $id);
        }
    }

    public function soaledit()
    {
        $idkuis = $this->request->getPost('idkuis');
        $idsoal = $this->request->getPost('idsoal');
        if ($this->request->getMethod() === 'post') {
            $simpan = [
                'soal' => $this->request->getPost('soal'),
                'a' => $this->request->getPost('a'),
                'b' => $this->request->getPost('b'),
                'c' => $this->request->getPost('c'),
                'd' => $this->request->getPost('d'),
                'kunci' => $this->request->getPost('kunci'),
                'bobot' => $this->request->getPost('bobot'),
            ];
            $this->db->table('soal')->where('idsoal', $idsoal)->update($simpan);

            session()->setFlashdata('success', 'Data berhasil disimpan.');
            return redirect()->to('/panel/ujianedit/' . $idkuis);
        }
    }

    public function soalhapus($id)
    {
        $idkuis = [];
        $soal = $this->db->table('soal')->where('idsoal', $id)->get()->getRow();
        $idkuis = $soal->idkuis;
        $this->db->table('soal')->where('idsoal', $id)->delete();
        session()->setFlashdata('success', 'Data berhasil dihapus.');
        return redirect()->to('/panel/ujianedit/' . $idkuis);
    }


    public function ujianjawab($id)
    {
        $idpengguna = session()->get('idpengguna');
        $kuis = $this->db->table('kuis')->join('kelas', 'kuis.idkelas = kelas.idkelas')->where('idkuis', $id)->get()->getRow();

        $siswa = $this->db->table('siswa')->where('idpengguna', $idpengguna)->get()->getRow();
        $idsiswa = $siswa->idsiswa;

        $jawaban = $this->db->table('jawaban')->join('siswa', 'jawaban.idsiswa = siswa.idsiswa')->where('jawaban.idsiswa', $idsiswa)->where('idkuis', $id)->get()->getResult();
        if (!empty($jawaban)) {
            return redirect()->to('/panel/ujianhasil/' . $kuis->idkuis);
        }
        $soal = $this->db->table('soal')
            ->where('idkuis', $id)
            ->orderBy('idsoal', 'asc')
            ->get()
            ->getResult();

        $data = [
            'title' => 'Jawab Ujian',
            'kuis' => $kuis,
            'jawaban' => $jawaban,
            'soal' => $soal,
        ];
        return view('panel/ujianjawab', $data);
    }

    public function ujianjawabsimpan()
    {
        if ($this->request->getMethod() === 'post') {
            $idpengguna = session()->get('idpengguna');
            $siswa = $this->db->table('siswa')->where('idpengguna', $idpengguna)->get()->getRow();
            $idsiswa = $siswa->idsiswa;

            $idkuis = $this->request->getPost('idkuis');
            $pilihan = $this->request->getPost('pilihan');
            $idsoal = $this->request->getPost('idsoal');

            $jumlah = $this->db->table('soal')->where('idkuis', $idkuis)->countAllResults();

            $score    = 0;
            $benar    = 0;
            $salah    = 0;
            $kosong    = 0;
            $hasilbobot = 0;
            for ($i = 0; $i < $jumlah; $i++) {
                $nomor = $idsoal[$i];
                if (empty($pilihan[$nomor])) {
                    $kosong++;
                } else {
                    $jawaban = $pilihan[$nomor];
                    $query = $this->db->table('soal')
                        ->select('*')
                        ->where('idsoal', $nomor)
                        ->where('kunci', $jawaban);
                    $cek = $query->countAllResults();
                    $query = $this->db->table('soal')
                        ->select('*')
                        ->where('idsoal', $nomor)
                        ->where('kunci', $jawaban);
                    $ambilsoal = $query->get()->getRow();
                    if ($cek) {
                        $hasilbobot += $ambilsoal->bobot;
                        $benar++;
                    } else {
                        $salah++;
                    }
                }

                // $score = 100 / $jumlah * $benar;
                // $hasil = number_format($score, 2);
                $hasil = $hasilbobot;
            }
            $this->db->table('jawaban')->insert([
                'idsiswa'   => $idsiswa,
                'idkuis'    => $idkuis,
                'benar'     => $benar,
                'salah'     => $salah,
                'nilai'     => $hasil,
            ]);
            $nomor = 0;
            $idjawaban = $this->db->insertID();
            for ($i = 0; $i < $jumlah; $i++) {
                $nomor = $idsoal[$i];
                if (empty($pilihan[$nomor])) {
                    $kosong++;
                } else {
                    $jawaban = $pilihan[$nomor];
                    $data = [
                        'idjawaban' => $idjawaban,
                        'idsoal'    => $nomor,
                        'jawaban'   => $jawaban
                    ];
                    $this->db->table('jawabandetail')->insert($data);
                }
            }
            session()->setFlashdata('success', 'Data berhasil disimpan.');
            return redirect()->to('/panel/ujianhasil/' . $idkuis);
        }
    }

    public function ujianhasil($id)
    {
        $idpengguna = session()->get('idpengguna');
        $siswa = $this->db->table('siswa')->where('idpengguna', $idpengguna)->get()->getRow();
        $idsiswa = $siswa->idsiswa;

        $kuis = $this->db->table('kuis')->join('kelas', 'kuis.idkelas = kelas.idkelas')->where('idkuis', $id)->get()->getRow();

        $jawaban = $this->db->table('jawaban')
            ->join('siswa', 'jawaban.idsiswa = siswa.idsiswa')
            ->join('pengguna', 'siswa.idpengguna = pengguna.idpengguna')
            ->where('jawaban.idsiswa', $idsiswa)->where('idkuis', $id)
            ->get()->getRow();
        // dd($jawaban);
        $soal = $this->db->table('soal')->where('idkuis', $id)->orderBy('idsoal', 'asc')->get()->getResult();

        foreach ($soal as $row) {
            $idsoal = $row->idsoal;
            $jawabandetail = $this->db->table('jawabandetail')->where('idjawaban', $jawaban->idjawaban)->where('idsoal', $idsoal)->get()->getRow();
            $row->jawabandetail = $jawabandetail;
        }

        $data = [
            'title' => 'Hasil Ujian',
            'kuis' => $kuis,
            'jawaban' => $jawaban,
            'soal' => $soal,
            'jawabandetail' => $jawabandetail,
        ];

        return view('panel/ujianhasil', $data);
    }

    public function ujianpenjawab($id)
    {

        $kuis = $this->db->table('kuis')->join('kelas', 'kuis.idkelas = kelas.idkelas')->where('idkuis', $id)->get()->getRow();

        $jawaban = $this->db->table('jawaban')
            ->join('siswa', 'jawaban.idsiswa = siswa.idsiswa')
            ->join('pengguna', 'siswa.idpengguna = pengguna.idpengguna')
            ->where('idkuis', $id)
            ->get()->getResult();

        $data = [
            'title' => 'Data Jawaban',
            'kuis' => $kuis,
            'jawaban' => $jawaban,
        ];
        return view('panel/ujianpenjawab', $data);
    }

    public function ujianriwayat()
    {
        $kuis = $this->db->table('kuis')->join('kelas', 'kuis.idkelas = kelas.idkelas')->get()->getRow();
        $jawaban = $this->db->table('jawaban')
            ->join('kuis', 'jawaban.idkuis = kuis.idkuis')
            ->join('kelas', 'kelas.idkelas = kuis.idkelas')
            ->join('siswa', 'jawaban.idsiswa = siswa.idsiswa')
            ->join('pengguna', 'siswa.idpengguna = pengguna.idpengguna')
            ->get()->getResult();
        $data = [
            'title' => 'Riwayat Jawaban Ujian',
            'kuis' => $kuis,
            'jawaban' => $jawaban,
        ];
        return view('panel/ujianriwayat', $data);
    }


    public function ujianhasiljawaban($idjawaban, $idkuis)
    {

        $kuis = $this->db->table('kuis')
            ->join('kelas', 'kuis.idkelas = kelas.idkelas')
            ->where('idkuis', $idkuis)->get()->getRow();

        $jawaban = $this->db->table('jawaban')
            ->join('siswa', 'jawaban.idsiswa = siswa.idsiswa')
            ->join('pengguna', 'siswa.idpengguna = pengguna.idpengguna')
            ->where('idjawaban', $idjawaban)
            ->where('idkuis', $idkuis)
            ->get()->getRow();
        // dd($jawaban);
        $soal = $this->db->table('soal')->where('idkuis', $idkuis)->orderBy('idsoal', 'asc')->get()->getResult();

        foreach ($soal as $row) {
            $idsoal = $row->idsoal;
            $jawabandetail = $this->db->table('jawabandetail')
                ->where('idjawaban', $jawaban->idjawaban)
                ->where('idsoal', $idsoal)
                ->get()->getRow();
            $row->jawabandetail = $jawabandetail;
        }

        $data = [
            'title' => 'Hasil Jawaban Ujian',
            'kuis' => $kuis,
            'jawaban' => $jawaban,
            'soal' => $soal,
            'jawabandetail' => $jawabandetail,
        ];

        return view('panel/ujianhasiljawaban', $data);
    }

    public function ujianjawabanhapus($idjawaban, $idkuis)
    {
        $this->db->table('jawaban')->where('idjawaban', $idjawaban)->delete();
        $this->db->table('jawabandetail')->where('idjawaban', $idjawaban)->delete();
        session()->setFlashdata('success', 'Data berhasil dihapus.');
        return redirect()->to('/panel/ujianpenjawab/' . $idkuis);
    }

    public function ujianpenjawabcetak($id)
    {
        $dompdf = new Dompdf();
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $kuis = $this->db->table('kuis')->join('kelas', 'kuis.idkelas = kelas.idkelas')->where('idkuis', $id)->get()->getRow();
        $jawaban = $this->db->table('jawaban')
            ->join('siswa', 'jawaban.idsiswa = siswa.idsiswa')
            ->join('pengguna', 'siswa.idpengguna = pengguna.idpengguna')
            ->where('idkuis', $id)
            ->get()->getResult();

        $data = [
            'kuis' => $kuis,
            'jawaban' => $jawaban,
        ];
        $html = view('panel/ujianpenjawabcetak', $data);
        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'potrait');

        $dompdf->render();

        $dompdf->stream("laporanujian.pdf", array("Attachment" => 0));
    }

    // Pengumuman
    public function pengumuman()
    {
        $pengumuman = $this->db->table('pengumuman')->get()->getResult();
        $data = [
            'title' => 'Daftar Pengumuman',
            'pengumuman' => $pengumuman,
        ];
        return view('panel/pengumumandaftar', $data);
    }

    public function pengumumantambah()
    {
        if ($this->request->getMethod() === 'post') {

            $namafoto = '';
            if ($this->request->getFile('foto')) {
                $foto = $this->request->getFile('foto');
                $namafoto = $foto->getRandomName();
                $foto->move('foto', $namafoto);
            }
            $simpan = [
                'judul' => $this->request->getPost('judul'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'tanggal' => $this->request->getPost('tanggal'),
                'foto' => $namafoto,
            ];
            $this->db->table('pengumuman')->insert($simpan);
            session()->setFlashdata('success', 'Data berhasil disimpan.');
            return redirect()->to('/panel/pengumuman');
        } else {
            $data = [
                'title' => 'Tambah Pengumuman',
            ];
            return view('panel/pengumumantambah', $data);
        }
    }

    public function pengumumanedit($id)
    {
        if ($this->request->getMethod() === 'post') {
            $simpan = [
                'judul' => $this->request->getPost('judul'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'tanggal' => $this->request->getPost('tanggal'),
            ];

            $pengumuman = $this->db->table('pengumuman')->where('idpengumuman', $id)->get()->getRow();
            $foto = $this->request->getFile('foto');

            if ($foto && $foto->isValid() && !$foto->hasMoved()) {
                if ($pengumuman->foto && file_exists('foto/' . $pengumuman->foto)) {
                    unlink('foto/' . $pengumuman->foto);
                }
                $foto = $this->request->getFile('foto');
                $namafoto = $foto->getRandomName();
                $foto->move('foto', $namafoto);
                $simpan['foto'] = $namafoto;
            }
            $this->db->table('pengumuman')->where('idpengumuman', $id)->update($simpan);
            session()->setFlashdata('success', 'Data berhasil disimpan.');
            return redirect()->to('/panel/pengumuman');
        } else {
            $data = [
                'title' => 'Edit Pengumuman',
                'id' => $id,
                'row' => $this->db->table('pengumuman')->where('idpengumuman', $id)->get()->getRow()

            ];
            return view('panel/pengumumanedit', $data);
        }
    }

    public function pengumumandetail($idpengumuman)
    {
        $data = [
            'title' => 'Detail Pengumuman',
            'row' => $this->db->table('pengumuman')->where('idpengumuman', $idpengumuman)->get()->getRow()
        ];
        return view('panel/pengumumandetail', $data);
    }

    public function pengumumanhapus($id)
    {
        $this->db->table('pengumuman')->where('idpengumuman', $id)->delete();
        session()->setFlashdata('success', 'Data berhasil disimpan.');
        return redirect()->to('/panel/pengumuman');
    }

    public function kurikulumdaftar()
    {
        $kurikulum = $this->db->table('kurikulum')->get()->getResult();
        $data = [
            'title' => 'Daftar kurikulum',
            'kurikulum' => $kurikulum,
        ];
        return view('panel/kurikulumdaftar', $data);
    }

    public function kurikulumtambah()
    {
        if ($this->request->getMethod() === 'post') {
            $simpan = [
                'namakurikulum' => $this->request->getPost('namakurikulum'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            $this->db->table('kurikulum')->insert($simpan);
            session()->setFlashdata('success', 'Data berhasil disimpan.');
            return redirect()->to('/panel/kurikulumdaftar');
        } else {
            $data = [
                'title' => 'Tambah Kurikulum',
            ];
            return view('panel/kurikulumtambah', $data);
        }
    }

    public function kurikulumedit($id)
    {
        if ($this->request->getMethod() === 'post') {
            $simpan = [
                'namakurikulum' => $this->request->getPost('namakurikulum'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            $this->db->table('kurikulum')->where('idkurikulum', $id)->update($simpan);
            session()->setFlashdata('success', 'Data berhasil disimpan.');
            return redirect()->to('/panel/kurikulumdaftar');
        } else {
            $data = [
                'title' => 'Edit Kurikulum',
                'id' => $id,
                'row' => $this->db->table('kurikulum')->where('idkurikulum', $id)->get()->getRow()

            ];
            return view('panel/kurikulumedit', $data);
        }
    }

    public function kurikulumhapus($id)
    {
        $this->db->table('kurikulum')->where('idkurikulum', $id)->delete();
        session()->setFlashdata('success', 'Data berhasil disimpan.');
        return redirect()->to('/panel/kurikulumdaftar');
    }

    // prestasi
    public function prestasi()
    {
        $prestasi = $this->db->table('prestasi')->get()->getResult();
        $data = [
            'title' => 'Daftar prestasi',
            'prestasi' => $prestasi,
        ];
        return view('panel/prestasidaftar', $data);
    }

    public function prestasitambah()
    {
        if ($this->request->getMethod() === 'post') {

            $namafoto = '';
            if ($this->request->getFile('foto')) {
                $foto = $this->request->getFile('foto');
                $namafoto = $foto->getRandomName();
                $foto->move('foto', $namafoto);
            }
            $simpan = [
                'judul' => $this->request->getPost('judul'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'tanggal' => $this->request->getPost('tanggal'),
                'foto' => $namafoto,
            ];
            $this->db->table('prestasi')->insert($simpan);
            session()->setFlashdata('success', 'Data berhasil disimpan.');
            return redirect()->to('/panel/prestasi');
        } else {
            $data = [
                'title' => 'Tambah prestasi',
            ];
            return view('panel/prestasitambah', $data);
        }
    }

    public function prestasiedit($id)
    {
        if ($this->request->getMethod() === 'post') {
            $simpan = [
                'judul' => $this->request->getPost('judul'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'tanggal' => $this->request->getPost('tanggal'),
            ];

            $prestasi = $this->db->table('prestasi')->where('idprestasi', $id)->get()->getRow();

            $foto = $this->request->getFile('foto');
            if ($foto && $foto->isValid() && !$foto->hasMoved()) {
                // Hapus foto lama jika ada
                if ($prestasi->foto && file_exists('foto/' . $prestasi->foto)) {
                    unlink('foto/' . $prestasi->foto);
                }
                // Upload foto baru
                $namafoto = $foto->getRandomName();
                $foto->move('foto', $namafoto);
                $simpan['foto'] = $namafoto;
            }

            $this->db->table('prestasi')->where('idprestasi', $id)->update($simpan);
            session()->setFlashdata('success', 'Data berhasil disimpan.');
            return redirect()->to('/panel/prestasi');
        } else {
            $data = [
                'title' => 'Edit prestasi',
                'id' => $id,
                'row' => $this->db->table('prestasi')->where('idprestasi', $id)->get()->getRow()
            ];
            return view('panel/prestasiedit', $data);
        }
    }

    public function prestasidetail($idprestasi)
    {
        $data = [
            'title' => 'Detail prestasi',
            'row' => $this->db->table('prestasi')->where('idprestasi', $idprestasi)->get()->getRow()
        ];
        return view('panel/prestasidetail', $data);
    }


    public function prestasihapus($id)
    {
        $this->db->table('prestasi')->where('idprestasi', $id)->delete();
        session()->setFlashdata('success', 'Data berhasil disimpan.');
        return redirect()->to('/panel/prestasi');
    }

    public function kegiatansekolahdaftar()
    {
        $kegiatansekolah = $this->db->table('kegiatansekolah')->get()->getResult();
        $data = [
            'title' => 'Daftar Kegiatan Sekolah',
            'kegiatansekolah' => $kegiatansekolah,
        ];
        return view('panel/kegiatansekolahdaftar', $data);
    }

    public function kegiatansekolahtambah()
    {
        if ($this->request->getMethod() === 'post') {
            $simpan = [
                'namakegiatan' => $this->request->getPost('namakegiatan'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'tanggal' => $this->request->getPost('tanggal'),
                'lokasi' => $this->request->getPost('lokasi'),
            ];
            $this->db->table('kegiatansekolah')->insert($simpan);
            session()->setFlashdata('success', 'Data berhasil disimpan.');
            return redirect()->to('/panel/kegiatansekolahdaftar');
        } else {
            $data = [
                'title' => 'Tambah kegiatansekolah',
            ];
            return view('panel/kegiatansekolahtambah', $data);
        }
    }

    public function kegiatansekolahedit($id)
    {
        if ($this->request->getMethod() === 'post') {
            $simpan = [
                'namakegiatan' => $this->request->getPost('namakegiatan'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'tanggal' => $this->request->getPost('tanggal'),
                'lokasi' => $this->request->getPost('lokasi'),
            ];
            $this->db->table('kegiatansekolah')->where('idkegiatansekolah', $id)->update($simpan);
            session()->setFlashdata('success', 'Data berhasil disimpan.');
            return redirect()->to('/panel/kegiatansekolahdaftar');
        } else {
            $data = [
                'title' => 'Edit Kegiatan Sekolah',
                'id' => $id,
                'row' => $this->db->table('kegiatansekolah')->where('idkegiatansekolah', $id)->get()->getRow()

            ];
            return view('panel/kegiatansekolahedit', $data);
        }
    }

    public function kegiatansekolahhapus($id)
    {
        $this->db->table('kegiatansekolah')->where('idkegiatansekolah', $id)->delete();
        session()->setFlashdata('success', 'Data berhasil disimpan.');
        return redirect()->to('/panel/kegiatansekolahdaftar');
    }

    public function cetakkartuujian($idkuis)
    {
        $idpengguna = session()->get('idpengguna');
        $level = session()->get('level');

        // Cek apakah level adalah Siswa
        if ($level != 'Siswa') {
            return redirect()->to('/')->with('error', 'Hanya siswa yang dapat mencetak kartu ujian.');
        }

        // Ambil data siswa
        $siswa = $this->db->table('siswa')
            ->join('pengguna', 'siswa.idpengguna = pengguna.idpengguna')
            ->join('kelas', 'siswa.idkelas = kelas.idkelas')
            ->where('siswa.idpengguna', $idpengguna)
            ->get()->getRow();

        // Ambil data ujian
        $kuis = $this->db->table('kuis')->where('idkuis', $idkuis)->get()->getRow();

        if (!$siswa || !$kuis) {
            return redirect()->to('/')->with('error', 'Data tidak ditemukan.');
        }

        $id_ujian = date('Ymd') . '_' . $siswa->nis;
        $waktu_ujian = tanggal(date("Y-m-d", strtotime($kuis->waktumulai))) . ' ' . date("H:i", strtotime($kuis->waktumulai)) . ' - ' . tanggal(date("Y-m-d", strtotime($kuis->waktuakhir))) . ' ' . date("H:i", strtotime($kuis->waktuakhir));

        // Load HTML content
        $html = view('panel/kartu_ujian', [
            'id_ujian' => $id_ujian,
            'siswa' => $siswa,
            'kuis' => $kuis,
            'waktu_ujian' => $waktu_ujian
        ]);

        // Initialize DomPDF
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('kartu_ujian.pdf', ['Attachment' => 1]);
    }
}
