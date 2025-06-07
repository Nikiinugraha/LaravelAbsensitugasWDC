@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Hero Section -->
    <div class="row align-items-center py-5">
        <div class="col-lg-6">
            <h1 class="display-4 fw-bold mb-4">Sistem Absensi Online</h1>
            <p class="lead mb-4">Mudah, Cepat, dan Efisien. Kelola kehadiran dengan lebih baik bersama kami.</p>
            <div class="d-flex gap-3">
                @auth
                <a href="{{ route('presence.index') }}" class="btn btn-primary btn-lg px-4">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Kelola Absensi
                </a>  
                <a href="#daftar-absensi" class="btn btn-outline-secondary btn-lg px-4">
                    <i class="bi bi-list-check me-2"></i>Lihat Daftar Absensi
                </a>
                @else
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Masuk Admin
                </a>
                <a href="#daftar-absensi" class="btn btn-outline-secondary btn-lg px-4">
                    <i class="bi bi-list-check me-2"></i>Lihat Daftar Absensi
                </a>
                @endauth
            </div>
        </div>
        <div class="col-lg-6 d-none d-lg-block">
            <img src="https://img.freepik.com/free-vector/attendance-concept-illustration_114360-8145.jpg" alt="Ilustrasi Absensi" class="img-fluid">
        </div>
    </div>

    <!-- Features Section -->
    <div class="row g-4 py-5" id="fitur">
        <h2 class="text-center mb-5">Mengapa Memilih Kami?</h2>
        
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle d-inline-flex mb-3">
                        <i class="bi bi-speedometer2 fs-1 text-primary"></i>
                    </div>
                    <h4>Cepat & Mudah</h4>
                    <p class="text-muted">Proses absensi yang cepat dan mudah digunakan oleh siapa saja.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <div class="bg-success bg-opacity-10 p-3 rounded-circle d-inline-flex mb-3">
                        <i class="bi bi-shield-check fs-1 text-success"></i>
                    </div>
                    <h4>Aman & Terpercaya</h4>
                    <p class="text-muted">Data kehadiran tersimpan dengan aman dan terjamin kerahasiaannya.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <div class="bg-warning bg-opacity-10 p-3 rounded-circle d-inline-flex mb-3">
                        <i class="bi bi-graph-up fs-1 text-warning"></i>
                    </div>
                    <h4>Laporan Real-time</h4>
                    <p class="text-muted">Pantau kehadiran secara real-time dengan mudah.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Absensi Section -->
    <div class="py-5" id="daftar-absensi">
        <h2 class="text-center mb-5">Daftar Absensi Tersedia</h2>
        <div class="row g-4">
            @forelse($presences ?? [] as $presence)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h5 class="card-title mb-0">{{ $presence->nama_kegiatan }}</h5>
                            <span class="badge bg-primary">{{ $presence->presenceDetails->count() }} Peserta</span>
                        </div>
                        <p class="text-muted small mb-3">
                            <i class="bi bi-calendar3 me-2"></i>
                            {{ \Carbon\Carbon::parse($presence->tgl_kegiatan)->translatedFormat('l, d F Y') }}
                        </p>
                        <div class="d-flex gap-2 mb-3">
                            <a href="{{ route('presence.show', $presence->id) }}" class="btn btn-outline-primary btn-sm flex-grow-1">
                                Isi Absensi
                            </a>
                            <button class="btn btn-outline-secondary btn-sm copy-link" 
                                    data-url="{{ route('presence.show', $presence->id) }}"
                                    title="Salin link absen">
                                <i class="bi bi-clipboard"></i>
                            </button>
                        </div>
                        <p class="text-muted small mb-4">
                            <i class="bi bi-clock me-2"></i>
                            {{ \Carbon\Carbon::parse($presence->tgl_kegiatan)->format('H:i') }} WIB
                        </p>
                        <a href="{{ route('presence.show', $presence->id) }}" class="btn btn-outline-primary w-100">
                            Isi Absensi
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="bi bi-calendar-x fs-1 text-muted"></i>
                    </div>
                    <h5>Belum ada jadwal absensi tersedia</h5>
                    <p class="text-muted">Silakan hubungi admin untuk informasi lebih lanjut</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-light py-4 mt-5">
    <div class="container">
        <div class="text-center text-muted">
            <p class="mb-0"> {{ date('Y') }} Sistem Absensi Online. All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fungsi untuk menyalin teks ke clipboard
        function copyToClipboard(text) {
            const textarea = document.createElement('textarea');
            textarea.value = text;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);
            
            // Tampilkan tooltip atau notifikasi
            const toast = document.createElement('div');
            toast.className = 'position-fixed bottom-0 end-0 m-3 p-3 bg-success text-white rounded shadow';
            toast.style.zIndex = '9999';
            toast.textContent = 'Link berhasil disalin!';
            document.body.appendChild(toast);
            
            // Hapus notifikasi setelah 2 detik
            setTimeout(() => {
                toast.remove();
            }, 2000);
        }

        // Tambahkan event listener untuk semua tombol copy
        document.querySelectorAll('.copy-link').forEach(button => {
            button.addEventListener('click', function() {
                const url = this.getAttribute('data-url');
                const fullUrl = window.location.origin + '/' + url;
                copyToClipboard(fullUrl);
                
                // Ganti ikon sementara
                const icon = this.querySelector('i');
                const originalClass = icon.className;
                icon.className = 'bi bi-check2';
                
                // Kembalikan ikon setelah 2 detik
                setTimeout(() => {
                    icon.className = originalClass;
                }, 2000);
            });
        });
    });
</script>
@endpush

@endsection