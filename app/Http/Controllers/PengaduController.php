<?php
namespace App\Http\Controllers;
use App\Models\Pengadu;
use Illuminate\Http\Request;
class PengaduController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengadu::query();

        if ($request->filled('cari')) {
            $cari = $request->cari;
            $query->where(function ($q) use ($cari) {
                $q->where('nama', 'like', "%{$cari}%")
                  ->orWhere('nik', 'like', "%{$cari}%");
            });
        }

        $pengadus = $query->latest()->paginate(10)->withQueryString();

        return view('pengadu.index', compact('pengadus'));
    }

    public function create()
    {
        return view('pengadu.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|digits:16|unique:pengadus,nik',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:20',
            'scan_ktp' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('scan_ktp')) {
            $validated['scan_ktp'] = $request->file('scan_ktp')->store('ktp', 'public');
        }

        Pengadu::create($validated);

        return redirect()->route('pengadu.index')->with('success', 'Data pengadu berhasil ditambahkan.');
    }

    public function show(Pengadu $pengadu)
    {
        return view('pengadu.show', compact('pengadu'));
    }

    public function edit(Pengadu $pengadu)
    {
        return view('pengadu.edit', compact('pengadu'));
    }

    public function update(Request $request, Pengadu $pengadu)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|digits:16|unique:pengadus,nik,' . $pengadu->id,
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:20',
            'scan_ktp' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('scan_ktp')) {
            $validated['scan_ktp'] = $request->file('scan_ktp')->store('ktp', 'public');
        }

        $pengadu->update($validated);

        return redirect()->route('pengadu.index')->with('success', 'Data pengadu berhasil diperbarui.');
    }

    public function destroy(Pengadu $pengadu)
    {
        $pengadu->delete();

        return redirect()->route('pengadu.index')->with('success', 'Data pengadu berhasil dihapus.');
    }
}