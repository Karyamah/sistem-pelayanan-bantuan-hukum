<?php
namespace App\Http\Controllers;
use App\Models\DokumentasiKegiatan;
use Illuminate\Http\Request;
class DokumentasiKegiatanController extends Controller
{
    public function index(Request $request)
    {
        $query = DokumentasiKegiatan::with('user');

        if ($request->filled('cari')) {
            $query->where('judul_kegiatan', 'like', "%{$request->cari}%");
        }

        $dokumentasis = $query->latest('tanggal_kegiatan')->paginate(9)->withQueryString();

        return view('dokumentasi.index', compact('dokumentasis'));
    }

    public function create()
    {
        return view('dokumentasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_kegiatan' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'keterangan' => 'nullable|string',
            'tanggal_kegiatan' => 'required|date',
        ]);

        $validated['foto'] = $request->file('foto')->store('dokumentasi', 'public');
        $validated['user_id'] = auth()->id();

        DokumentasiKegiatan::create($validated);

        return redirect()->route('dokumentasi.index')->with('success', 'Dokumentasi kegiatan berhasil ditambahkan.');
    }

    public function show(DokumentasiKegiatan $dokumentasi)
    {
        return view('dokumentasi.show', compact('dokumentasi'));
    }

    public function edit(DokumentasiKegiatan $dokumentasi)
    {
        return view('dokumentasi.edit', compact('dokumentasi'));
    }

    public function update(Request $request, DokumentasiKegiatan $dokumentasi)
    {
        $validated = $request->validate([
            'judul_kegiatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'keterangan' => 'nullable|string',
            'tanggal_kegiatan' => 'required|date',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('dokumentasi', 'public');
        }

        $dokumentasi->update($validated);

        return redirect()->route('dokumentasi.index')->with('success', 'Dokumentasi kegiatan berhasil diperbarui.');
    }

    public function destroy(DokumentasiKegiatan $dokumentasi)
    {
        $dokumentasi->delete();

        return redirect()->route('dokumentasi.index')->with('success', 'Dokumentasi kegiatan berhasil dihapus.');
    }
}

