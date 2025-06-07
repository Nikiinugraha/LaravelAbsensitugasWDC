@extends('layouts/main')

@section('content')
<div class="container my-4">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h4 class="card-title">Daftar Absensi Pembelajaran</h4>
                </div>
                <div class="col text-end">
                    <a href="{{ route('presence.create') }}" class="btn btn-success">Tambah Absen</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Mata Pelajaran</th>
                        <th>Tanggal Pembelajaran</th>
                        <th>Waktu Pembelajaran Dimulai</th>
                        <th>Opsi</th>
                    </tr>
                </thead>

                <tbody>
                    @if ($presences->IsEmpty())
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data</td>
                        </tr>
                    @endif
                    @foreach ($presences as $presence)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $presence->nama_kegiatan }}</td>
                            <td>{{ date('d-m-Y', strtotime($presence->tgl_kegiatan)) }}</td>
                            <td>{{ date('H:i', strtotime($presence->tgl_kegiatan)) }}</td>
                            <td>
                                <a href="{{ route('presence.show', $presence->id) }}" class="btn btn-primary">Detail</a>
                                <a href="{{ route('presence.edit', $presence->id) }}" class="btn btn-warning">Edit</a>

                                <form action="{{ route('presence.destroy', $presence->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin mengahapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
    
@endsection