<?php
namespace App\Http\Controllers;
use App\Models\Notulensi;
use App\Models\Pengadu;
use Illuminate\Http\Request;
class NotulensiController extends Controller
{
    public function index(Request $request)
    {
        $query = Notulensi::with(['pengadu']);

        if ($request->filled('cari')) {
            $cari = $request->cari;
            $query->where(function ($q) use ($cari) {
                $q->where('no_registrasi', 'like', "%{$cari}%")
                  ->orWhere('perihal', 'like', "%{$cari}%")
                  ->orWhereHas('pengadu', function ($q2) use ($cari) {
                      $q2->where('nama', 'like', "%{$cari}%");
                  });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $notulensis = $query->latest()->paginate(10)->withQueryString();

        return view('notulensi.index', compact('notulensis'));
    }

    public function create(Request $request)
{
    $pengadus = Pengadu::orderBy('nama')->get();
    $noRegistrasi = 'BH-' . date('Ym') . '-' . str_pad((Notulensi::whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'))->count() + 1), 4, '0', STR_PAD_LEFT);
    $selectedPengadu = $request->filled('pengadu_id') ? Pengadu::find($request->pengadu_id) : null;

    return view('notulensi.create', compact('pengadus', 'noRegistrasi', 'selectedPengadu'));
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_registrasi' => 'required|string|unique:notulensis,no_registrasi',
            'tanggal_waktu' => 'required|date',
            'pengadu_id' => 'required|exists:pengadus,id',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'umur' => 'required|integer|min:1|max:150',
            'perihal' => 'required|string|max:255',
            'uraian_kronologi' => 'required|string',
            'penanganan' => 'nullable|string',
            'status' => 'required|in:konsultasi,dilimpahkan,ditindaklanjuti,ditangani_jabis,selesai',
            'pic' => 'nullable|string|max:255',
            'notulis' => 'nullable|string|max:255',
            'catatan' => 'nullable|string',
        ]);
                $validated['dicatat_oleh'] = auth()->id();


     $notulensi = Notulensi::create($validated);

return redirect()->route('pengadu.show', $notulensi->pengadu_id)->with('success', 'Notulensi berhasil ditambahkan.');
    }

    public function show(Notulensi $notulensi)
    {
        $notulensi->load(['pengadu']);
        return view('notulensi.show', compact('notulensi'));
    }

    public function edit(Notulensi $notulensi)
    {
        $pengadus = Pengadu::orderBy('nama')->get();

        return view('notulensi.edit', compact('notulensi', 'pengadus'));
    }

    public function update(Request $request, Notulensi $notulensi)
    {
        $validated = $request->validate([
            'no_registrasi' => 'required|string|unique:notulensis,no_registrasi,' . $notulensi->id,
            'tanggal_waktu' => 'required|date',
            'pengadu_id' => 'required|exists:pengadus,id',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'umur' => 'required|integer|min:1|max:150',
            'perihal' => 'required|string|max:255',
            'uraian_kronologi' => 'required|string',
            'penanganan' => 'nullable|string',
            'status' => 'required|in:konsultasi,dilimpahkan,ditindaklanjuti,ditangani_jabis,selesai',
            'pic' => 'nullable|string|max:255',
            'notulis' => 'nullable|string|max:255',
            'catatan' => 'nullable|string',
        ]);
        

      $notulensi->update($validated);

return redirect()->route('pengadu.show', $notulensi->pengadu_id)->with('success', 'Notulensi berhasil diperbarui.');  
    }

    public function destroy(Notulensi $notulensi)
    {
        $notulensi->delete();

        return redirect()->route('notulensi.index')->with('success', 'Notulensi berhasil dihapus.');
    }
}