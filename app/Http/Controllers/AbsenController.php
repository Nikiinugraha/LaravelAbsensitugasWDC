<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use App\Models\PresenceDetail;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    public function index($slug)
    {
        $presence = Presence::where('slug', $slug)->firstOrFail();
        $title = 'Absensi ' . $presence->nama_kegiatan;
        return view('pages.absen.index', compact('presence', 'title'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'presence_id' => 'required|exists:presences,id',
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:100',
            'absen' => 'required|in:Hadir,Izin,Sakit,Alpha',
            'tanda_tangan' => 'required|string',
        ]);

        PresenceDetail::create($validated);

        return redirect()
            ->route('absen.index', Presence::find($request->presence_id)->slug)
            ->with('success', 'Absensi berhasil disimpan!');
    }
}
