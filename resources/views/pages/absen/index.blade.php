<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $presence->nama_kegiatan ?? 'Absensi Online' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  </head>
  <body>
    <div class="container my-5">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card mb-2">
            <div class="card-body">
                <h4 class="text-center">Absensi Pembelajaran</h4>
            </div>

            <table class="table table-borderless">
                <tr>
                    <td width="250">Mata Pelajaran</td>
                    <td width="50">:</td>
                    <td>{{ $presence->nama_kegiatan }}</td>
                </tr>
                <tr>
                    <td>Tanggal Pembelajaran</td>
                    <td>:</td>
                    <td>{{ date('d F Y', strtotime($presence->tgl_kegiatan)) }}</td>
                </tr>
                <tr>
                    <td>Waktu Pembelajaran Dimulai</td>
                    <td>:</td>
                    <td>{{ date('H:i', strtotime($presence->tgl_kegiatan)) }}</td>
                </tr>
            </table>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Form Absensi</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('absen.save') }}" method="POST">
                            @csrf
                            <input type="hidden" name="presence_id" value="{{ $presence->id }}">
                            
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="kelas" class="form-label">Kelas</label>
                                <input type="text" class="form-control @error('kelas') is-invalid @enderror" id="kelas" name="kelas" value="{{ old('kelas') }}" required>
                                @error('kelas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="absen" class="form-label">Status Kehadiran</label>
                                <select class="form-select @error('absen') is-invalid @enderror" id="absen" name="absen" required>
                                    <option value="" selected disabled>Pilih status kehadiran</option>
                                    <option value="Hadir" {{ old('absen') == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                                    <option value="Izin" {{ old('absen') == 'Izin' ? 'selected' : '' }}>Izin</option>
                                    <option value="Sakit" {{ old('absen') == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                                    <option value="Alpha" {{ old('absen') == 'Alpha' ? 'selected' : '' }}>Alpha</option>
                                </select>
                                @error('absen')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100">Kirim Absen</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Daftar Kehadiran</h4>
                    </div>
                    <div class="card-body">
                        @if($presence->presenceDetails->isEmpty())
                            <p class="text-center text-muted">Belum ada data kehadiran</p>
                        @else
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($presence->presenceDetails as $index => $detail)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $detail->nama }}</td>
                                                <td>{{ $detail->kelas }}</td>
                                                <td>{{ $detail->absen }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  </body>
</html>