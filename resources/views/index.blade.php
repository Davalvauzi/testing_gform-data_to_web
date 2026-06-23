<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prototipe Dashboard Les v1.0</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bar/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container my-5">
        <div class="p-4 bg-white shadow-sm rounded-3 mb-4 text-center">
            <h2 class="fw-bold text-primary">Sistem Manajemen Jawaban Google Form</h2>
            <p class="text-muted">Status Server Localhost: <span class="badge bg-success">Aktif</span></p>
        </div>

        <div class="card border-0 shadow-sm mb-5">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">👨‍🏫 Dashboard Guru (Multi-Korektor)</h5>
                <span class="badge bg-primary">Akses: Guru / Admin</span>
            </div>
            <div class="card-body">
                <p class="text-muted small">Guru dapat melihat semua data siswa, memeriksa esai, dan memberikan nilai
                    langsung.</p>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Email</th>
                                <th>Jawaban Soal 1</th>
                                <th>Jawaban Soal 2</th>
                                <th>Status</th>
                                <th>Nilai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($semuaTugas as $tugas)
                                <tr>
                                    <td class="fw-bold">{{ $tugas->nama }}</td>
                                    <td>{{ $tugas->email }}</td>
                                    <td><small class="text-truncate d-inline-block"
                                            style="max-width: 150px;">{{ $tugas->jawaban_1 }}</small></td>
                                    <td><small class="text-truncate d-inline-block"
                                            style="max-width: 150px;">{{ $tugas->jawaban_2 }}</small></td>
                                    <td>
                                        @if ($tugas->status_koreksi == 'Belum Dikoreksi')
                                            <span class="badge bg-danger">Belum Dikoreksi</span>
                                        @else
                                            <span class="badge bg-success">Sudah Dikoreksi</span>
                                        @endif
                                    </td>
                                    <td class="fw-bold text-center">{{ $tugas->nilai }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#koreksiModal{{ $tugas->id }}">
                                            📝 Koreksi
                                        </button>
                                    </td>
                                </tr>

                                <div class="modal fade" id="koreksiModal{{ $tugas->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Koreksi Jawaban: {{ $tugas->nama }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="#" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="fw-bold text-secondary">Pertanyaan & Jawaban
                                                            1:</label>
                                                        <div class="p-3 bg-light rounded">{{ $tugas->jawaban_1 }}</div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="fw-bold text-secondary">Pertanyaan & Jawaban
                                                            2:</label>
                                                        <div class="p-3 bg-light rounded">{{ $tugas->jawaban_2 }}</div>
                                                    </div>
                                                    <hr>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold text-primary">Input Nilai Siswa
                                                            (0 - 100)
                                                            :</label>
                                                        <input type="number" class="form-control" name="nilai"
                                                            value="{{ $tugas->nilai }}" min="0" max="100"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="button" class="btn btn-success"
                                                        onclick="alert('Prototipe: Nilai berhasil disimpan!')">Simpan
                                                        Nilai</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">Belum ada data siswa yang
                                        masuk dari Google Form.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">🎓 Dashboard Siswa (Simulasi Akun Terlogin)</h5>
                <span class="badge bg-light text-primary">Akses: Siswa</span>
            </div>
            <div class="card-body">
                <p class="text-muted small">Jika sistem auth sudah aktif, siswa hanya akan melihat baris miliknya
                    sendiri berdasarkan email login mereka.</p>

                <div class="alert alert-info py-2">
                    <strong>Info Simulasi:</strong> Menampilkan contoh ringkas raport di halaman siswa.
                </div>

                <div class="row">
                    @forelse($semuaTugas->take(2) as $tugas)
                        {{-- Hanya simulasi ambil 2 sampel data --}}
                        <div class="col-md-6 mb-3">
                            <div class="p-3 border rounded-3 bg-white shadow-sm">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="fw-bold mb-0 text-dark">{{ $tugas->nama }}</h6>
                                    <span
                                        class="badge {{ $tugas->status_koreksi == 'Sudah Dikoreksi' ? 'bg-success' : 'bg-warning text-dark' }}">
                                        {{ $tugas->status_koreksi }}
                                    </span>
                                </div>
                                <p class="text-muted small mb-2">Email: {{ $tugas->email }}</p>
                                <div class="bg-light p-2 rounded text-center mb-0">
                                    <span class="text-secondary small d-block">Nilai Tugas Anda</span>
                                    <h3 class="fw-bold text-success mb-0">{{ $tugas->nilai }} <span
                                            class="fs-6 text-muted">/ 100</span></h3>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center text-muted py-3">Belum ada riwayat nilai.</div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
