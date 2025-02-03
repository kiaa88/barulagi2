<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\BarangModel;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BarangExport;

class BarangController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = BarangModel::select('id', 'kode_barang', 'nama_barang', 'stock', 'gambar', 'kategori')->get();

            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('kode_barang', function ($row) {
                    return $row->kode_barang;
                })
                ->addColumn('nama_barang', function ($row) {
                    return $row->nama_barang;
                })
                ->addColumn('stock', function ($row) {
                    return $row->stock;
                })
                ->addColumn('gambar', function ($row) {
                    return $row->gambar ? '<img src="' . asset('storage/' . $row->gambar) . '" width="50" />' : 'No Image';
                })
                ->addColumn('kategori', function ($row) {
                    return $row->kategori;
                })
                ->addColumn('action', function ($row) {
                    $btnEdit = '<button type="button" class="btn p-0 mx-1 btn-edit" data-id="' . $row->id . '" title="Edit"><i class="fa-solid fa-pen-to-square text-success"></i></button>';
                    $btnHapus = '<button type="button" class="btn p-0 mx-1 btn-hapus" data-id="' . $row->id . '" title="Delete"><i class="fa-solid fa-trash-can text-danger"></i></button>';

                    return $btnEdit . $btnHapus;
                })
                ->rawColumns(['gambar', 'action'])
                ->make(true);
        }

        // Get all categories for dropdown
        $categories = KategoriModel::select('id', 'nama')->get();
        return view('dashboard.pages.barang.view', compact('categories'));
    }

    public function delete($id)
    {
        $barang = BarangModel::find($id);
        if ($barang) {
            $barang->delete();
            return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Data tidak ditemukan.']);
        }
    }
    public function insert(Request $request)
    {
        $validCategories = KategoriModel::pluck('nama')->toArray();
    
        $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'stock' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'kategori' => ['required', 'in:' . implode(',', $validCategories)],
        ]);
    
        // Cek apakah gambar ada dan valid
        if ($request->hasFile('gambar') && $request->file('gambar')->isValid()) {
            $imagePath = $request->file('gambar')->store('uploads', 'public');
    
            // Periksa apakah gambar berhasil disimpan
            dd($imagePath); // Menggunakan dd untuk debugging
    
            BarangModel::create([
                'kode_barang' => $request->kode_barang,
                'nama_barang' => $request->nama_barang,
                'stock' => $request->stock,
                'gambar' => $imagePath,
                'kategori' => $request->kategori,
            ]);
    
            Alert::success('Success', 'Data berhasil disimpan');
            return redirect()->back();
        }
    
        // Menangani jika gambar tidak valid
        return redirect()->back()->withErrors(['gambar' => 'Gambar tidak valid']);
    }
    

    public function edit($id)
    {
        $barang = BarangModel::find($id);
        $categories = KategoriModel::select('id', 'nama')->get();
        return response()->json([
            'id' => $barang->id,
            'kode_barang' => $barang->kode_barang,
            'nama_barang' => $barang->nama_barang,
            'stock' => $barang->stock,
            'gambar' => $barang->gambar,
            'kategori' => $barang->kategori,
            'categories' => $categories
        ]);
    }

    public function update(Request $request)
    {
        $validCategories = KategoriModel::pluck('nama')->toArray();

        $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'stock' => 'required',
            'kategori' => ['required', 'in:' . implode(',', $validCategories)],
        ]);

        $barang = BarangModel::find($request->id);

        if ($barang) {
            $barang->update([
                'kode_barang' => $request->kode_barang,
                'nama_barang' => $request->nama_barang,
                'stock' => $request->stock,
                'gambar' => $request->gambar, // Consider handling image upload separately if it's updated
                'kategori' => $request->kategori,
            ]);

            return response()->json(['status' => 'success', 'message' => 'Data berhasil diupdate.']);
        }

        return response()->json(['status' => 'error', 'message' => 'Barang tidak ditemukan.']);
    }

    public function export_excel()
    {
        return Excel::download(new BarangExport, 'barang.xlsx');
    }
}
