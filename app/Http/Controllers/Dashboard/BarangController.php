<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\BarangModel;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BarangController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = [];

            $query = BarangModel::query();

            $query->chunk(100, function ($barangChunk) use (&$data) {
                foreach ($barangChunk as $databarang) {
                    $data[] = [
                        'id' => $databarang->id ?? '',
                        'nama_barang' => $databarang->nama_barang ?? '',
                        'stock' => $databarang->stock ?? '',
                        'harga' => $databarang->harga ?? '',
                        'kategori' => $databarang->kategori ?? '',
                    ];
                }
            });

            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row['nama_barang'];
                })
                ->addColumn('stock', function ($row) {
                    return $row['stock'];
                })
                ->addColumn('phone', function ($row) {
                    return $row['harga'];
                })
                ->addColumn('alamat', function ($row) {
                    return $row['kategori'];
                })
                ->addColumn('action', function ($row) {
                    $btnEdit = '<button type="button" class="btn p-0 mx-1 btn-edit" data-id="' . $row['id'] . '" title="Edit"><i class="fa-solid fa-pen-to-square text-success"></i></button>';
                    $btnHapus = '<button type="button" class="btn p-0 mx-1 btn-hapus" data-id="' . $row['id'] . '" title="Delete"><i class="fa-solid fa-trash-can text-danger"></i></button>';

                    return $btnEdit . $btnHapus;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        
        // Get all categories
        $categories = KategoriModel::select('id', 'nama')->get();
        return view('dashboard.pages.barang.view', compact('categories'));
    }
    public function delete($id)
                {
                    $biodata = BarangModel::find($id);
                    if ($biodata) {
                        $biodata->delete();
                        return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus.']);
                    } else {
                        return response()->json(['status' => 'error', 'message' => 'Data tidak ditemukan.']);
                    }
                }
    public function insert(Request $request)
    {
        $validCategories = KategoriModel::pluck('nama')->toArray();
        
        $request->validate([
            'name' => 'required',
            'stock' => 'required',
            'phone' => 'required',
            'alamat' => ['required', 'in:'.implode(',', $validCategories)],
        ]);

        // $biodata = new BiodataModel();
        // $biodata->name = $request->name;
        // $biodata->email = $request->email;
        // $biodata->phone = $request->phone;
        // $biodata->alamat = $request->alamat;
        // $biodata->save();

        BarangModel::create([
            'nama_barang' => $request->name,
            'stock' => $request->stock,
            'harga' => $request->phone,
            'kategori' => $request->alamat,
        ]);

        Alert::success('Success', 'Data berhasil disimpan');
        return redirect()->back();
    }

    public function edit($id)
    {
        $barang = BarangModel::find($id);
        $categories = KategoriModel::select('id', 'nama')->get();
        return response()->json([
            'id' => $barang->id,
            'name' => $barang->nama_barang,
            'stock' => $barang->stock,
            'phone' => $barang->harga,
            'alamat' => $barang->kategori,
            'categories' => $categories
        ]);
    }

    public function update(Request $request)
    {
        $validCategories = KategoriModel::pluck('nama')->toArray();
        
        $request->validate([
            'name' => 'required',
            'stock' => 'required',
            'phone' => 'required',
            'alamat' => ['required', 'in:'.implode(',', $validCategories)],
        ]);

        // $biodata = BiodataModel::find($request->id);
        // $biodata->name = $request->name;
        // $biodata->email = $request->email;
        // $biodata->phone = $request->phone;
        // $biodata->alamat = $request->alamat;
        // $biodata->save();

        BarangModel::where('id', $request->id)->update([
            'nama_barang' => $request->name,
            'stock' => $request->stock,
            'harga' => $request->phone,
            'kategori' => $request->alamat,
        ]);

        return response()->json(['status' => 'success', 'message' => 'Data berhasil diupdate.']);
    }

}
