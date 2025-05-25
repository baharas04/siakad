<?= $this->extend('panel/templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card shadow mt-4">
                <div class="card-body">
                    <h4 class="card-title">Selamat Datang, <?= session('nama') ?></h4>
                    <?php
                    if (session('level') == 'Admin' or session('level') == 'Pimpinan') { ?>
                        <div class="row justify-content-center">
                            <div class="col-md-6 mb-4 stretch-card transparent">
                                <div class="card card-tale">
                                    <div class="card-body">
                                        <p class="mb-4">Jumlah Kelas</p>
                                        <p class="fs-30 mb-2"><?= $jumlahkelas ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4 stretch-card transparent">
                                <div class="card card-dark-blue">
                                    <div class="card-body">
                                        <p class="mb-4">Jumlah Mata Pelajaran</p>
                                        <p class="fs-30 mb-2"><?= $jumlahmatapelajaran ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4 stretch-card transparent">
                                <div class="card card-light-blue">
                                    <div class="card-body">
                                        <p class="mb-4">Jumlah Siswa</p>
                                        <p class="fs-30 mb-2"><?= $jumlahsiswa ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4 stretch-card transparent">
                                <div class="card card-light-danger">
                                    <div class="card-body">
                                        <p class="mb-4">Jumlah Guru</p>
                                        <p class="fs-30 mb-2"><?= $jumlahguru ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4 stretch-card transparent">
                                <div class="card card-light-danger bg-success">
                                    <div class="card-body">
                                        <p class="mb-4">Jumlah Ujian</p>
                                        <p class="fs-30 mb-2"><?= $jumlahujian ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php
                    if (session('level') == 'Guru') { ?>
                        <div class="row justify-content-center">
                            <div class="col-md-6 mb-4 stretch-card transparent">
                                <div class="card card-tale">
                                    <div class="card-body">
                                        <p class="mb-4">Jumlah Kelas</p>
                                        <p class="fs-30 mb-2"><?= $jumlahkelas ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4 stretch-card transparent">
                                <div class="card card-light-blue">
                                    <div class="card-body">
                                        <p class="mb-4">Jumlah Siswa</p>
                                        <p class="fs-30 mb-2"><?= $jumlahsiswa ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4 stretch-card transparent">
                                <div class="card card-light-danger bg-success">
                                    <div class="card-body">
                                        <p class="mb-4">Jumlah Ujian</p>
                                        <p class="fs-30 mb-2"><?= $jumlahujian ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (session('level') == 'Siswa') { ?>
                        <!-- Student Dashboard -->
                        <div class="container py-4">
                            <!-- Prestasi Section -->
                            <section class="mb-5">


                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="fw-bold"><i class="bi bi-trophy"></i> Prestasi Terbaru</h4>
                                </div>

                                <div class="row row-cols-1 row-cols-md-3 g-4" id="prestasiCards">
                                    <?php if (empty($prestasi)): ?>
                                        <div class="col-12">
                                            <div class="alert alert-info">
                                                Belum ada data prestasi saat ini.
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <?php foreach ($prestasi as $prestasi_item) : ?>
                                            <div class="col mb-4 prestasi-item">
                                                <div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden">
                                                    <div class="position-relative">
                                                        <div class="position-absolute top-0 start-0 bg-dark bg-opacity-50 text-white p-2 small">
                                                            <i class="bi bi-calendar-event me-1"></i><?= esc($prestasi_item->tanggal); ?>
                                                        </div>
                                                        <img src="<?= base_url('foto/' . $prestasi_item->foto) ?>" class="card-img-top" alt="<?= esc($prestasi_item->judul); ?>" style="height: 200px; object-fit: cover;">
                                                    </div>
                                                    <div class="card-body d-flex flex-column">
                                                        <h5 class="card-title fw-bold mb-2"><?= esc($prestasi_item->judul); ?></h5>
                                                        <p class="card-text text-secondary">
                                                            <?= strlen(strip_tags($prestasi_item->deskripsi)) > 100 ? substr(strip_tags($prestasi_item->deskripsi), 0, 100) . '...' : strip_tags($prestasi_item->deskripsi); ?>
                                                        </p>
                                                        <a href="<?= base_url('panel/prestasidetail/' . $prestasi_item->idprestasi); ?>" class="btn btn-sm btn-outline-primary mt-auto">Baca Selengkapnya</a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>

                                <div class="d-flex justify-content-center mt-4" id="prestasiPaginationControls"></div>


                                <!-- Pagination for Prestasi -->
                            </section>

                            <!-- Pengumuman Section -->
                            <section class="mb-5">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="fw-bold"><i class="bi bi-megaphone"></i> Pengumuman Terbaru</h4>
                                </div>

                                <div class="row row-cols-1 row-cols-md-3 g-4" id="pengumumanCards">
                                    <?php if (empty($pengumuman)): ?>
                                        <div class="col-12">
                                            <div class="alert alert-info">
                                                Belum ada pengumuman saat ini.
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <?php foreach ($pengumuman as $row) : ?>
                                            <div class="col mb-4 pengumuman-item">
                                                <div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden">
                                                    <div class="position-relative">
                                                        <div class="position-absolute top-0 start-0 bg-dark bg-opacity-50 text-white p-2 small">
                                                            <i class="bi bi-calendar-event me-1"></i><?= esc($row->tanggal); ?>
                                                        </div>
                                                        <img src="<?= base_url('foto/' . $row->foto) ?>" class="card-img-top" alt="<?= esc($row->judul); ?>" style="height: 200px; object-fit: cover;">
                                                    </div>
                                                    <div class="card-body d-flex flex-column">
                                                        <h5 class="card-title fw-bold mb-2"><?= esc($row->judul); ?></h5>
                                                        <p class="card-text text-secondary">
                                                            <?= strlen(strip_tags($row->deskripsi)) > 100 ? substr(strip_tags($row->deskripsi), 0, 100) . '...' : strip_tags($row->deskripsi); ?>
                                                        </p>
                                                        <a href="<?= base_url('panel/pengumumandetail/' . $row->idpengumuman) ?>" class="btn btn-sm btn-primary mt-auto"><i class="bi bi-eye me-1"></i>Detail</a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                </div>

                                <!-- Pagination for Pengumuman -->
                                <div class="d-flex justify-content-center mt-4" id="paginationControls"></div>

                                <br>
                                <?php
                                $tahun_sekarang = date('Y');
                                $tahun_terpilih = isset($_GET['tahun']) ? $_GET['tahun'] : $tahun_sekarang;
                                ?>

                                <!-- Header Grafik dan Filter Tahun -->
                                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                                    <h4 class="fw-bold mb-0"><i class="bi bi-trophy"></i> Grafik Prestasi</h4>
                                    <div>
                                        <select id="filterTahun" class="form-select form-select-sm">
                                            <?php for ($i = $tahun_sekarang; $i >= $tahun_sekarang - 10; $i--): ?>
                                                <option value="<?= $i ?>" <?= $i == $tahun_terpilih ? 'selected' : '' ?>><?= $i ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Grafik Prestasi Siswa per Bulan -->
                                <div class="card shadow-sm border-0 mb-4">
                                    <div class="card-body">
                                        <canvas id="prestasiChart" style="height: 320px;"></canvas>
                                    </div>
                                </div>

                            </section>
                        </div>

                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script>
                            document.getElementById('filterTahun').addEventListener('change', function() {
                                const selectedYear = this.value;
                                const url = new URL(window.location.href);
                                url.searchParams.set('tahun', selectedYear);
                                window.location.href = url.toString();
                            });
                        </script>

                        <script>
                            // Mendapatkan data prestasi per bulan dari PHP
                            const prestasiPerBulan = <?= json_encode($prestasi_per_bulan); ?>;
                            const bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

                            // Membuat grafik menggunakan Chart.js
                            const ctx = document.getElementById('prestasiChart').getContext('2d');
                            const prestasiChart = new Chart(ctx, {
                                type: 'bar', // Jenis grafik bar
                                data: {
                                    labels: bulan, // Label bulan
                                    datasets: [{
                                        label: 'Jumlah Prestasi per Bulan',
                                        data: prestasiPerBulan, // Data jumlah prestasi per bulan
                                        backgroundColor: 'rgba(75, 192, 192, 0.2)', // Warna latar belakang bar
                                        borderColor: 'rgba(75, 192, 192, 1)', // Warna border bar
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    scales: {
                                        y: {
                                            beginAtZero: true // Memastikan sumbu Y dimulai dari 0
                                        }
                                    }
                                }
                            });
                        </script>


                        <!-- Pagination JavaScript -->
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                // Pagination for Prestasi and Pengumuman
                                ['.prestasi-item', '.pengumuman-item'].forEach(selector => {
                                    initPagination(selector, 6, selector === '.prestasi-item' ? 'prestasiPaginationControls' : 'paginationControls');
                                });

                                // Function to handle pagination
                                function initPagination(itemSelector, itemsPerPage, controlsId) {
                                    const items = document.querySelectorAll(itemSelector);
                                    const paginationControls = document.getElementById(controlsId);
                                    let currentPage = 1;

                                    if (!items.length || !paginationControls) return;

                                    function showPage(page) {
                                        const [start, end] = [(page - 1) * itemsPerPage, page * itemsPerPage];
                                        items.forEach((item, index) => item.style.display = index >= start && index < end ? 'block' : 'none');
                                    }

                                    function createPagination() {
                                        paginationControls.innerHTML = '';
                                        const pageCount = Math.ceil(items.length / itemsPerPage);
                                        if (pageCount <= 1) return;

                                        const createPageLink = (text, page, isDisabled = false) => {
                                            const li = document.createElement('li');
                                            li.classList.add('page-item', isDisabled && 'disabled', page === currentPage && 'active');
                                            const link = document.createElement('a');
                                            link.classList.add('page-link');
                                            link.href = '#';
                                            link.innerText = text;
                                            if (!isDisabled) {
                                                link.addEventListener('click', e => {
                                                    e.preventDefault();
                                                    currentPage = page;
                                                    showPage(currentPage);
                                                    createPagination();
                                                });
                                            }
                                            li.appendChild(link);
                                            return li;
                                        };

                                        const nav = document.createElement('nav');
                                        const ul = document.createElement('ul');
                                        ul.classList.add('pagination', 'pagination-sm');

                                        ul.appendChild(createPageLink('previous', currentPage - 1, currentPage === 1)); // Previous
                                        if (currentPage > 3) ul.appendChild(createPageLink(1, 1)); // First page with ellipsis if needed
                                        if (currentPage > 4) ul.appendChild(createPageLink('...', 0, true)); // Ellipsis

                                        const startPage = Math.max(1, currentPage - 2);
                                        const endPage = Math.min(pageCount, startPage + 4);
                                        for (let i = startPage; i <= endPage; i++) {
                                            ul.appendChild(createPageLink(i, i));
                                        }

                                        if (currentPage < pageCount - 3) ul.appendChild(createPageLink('...', 0, true)); // Ellipsis
                                        if (currentPage < pageCount - 2) ul.appendChild(createPageLink(pageCount, pageCount)); // Last page
                                        ul.appendChild(createPageLink('next', currentPage + 1, currentPage === pageCount)); // Next

                                        nav.appendChild(ul);
                                        paginationControls.appendChild(nav);
                                    }

                                    showPage(currentPage);
                                    createPagination();
                                }
                            });
                        </script>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>