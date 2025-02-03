<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = KategoriModel::select('id', 'nama', 'deskripsi')->get();

            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->nama;
                })
                ->addColumn('alamat', function ($row) {
                    return $row->deskripsi;
                })
                ->addColumn('action', function ($row) {
                    $btnEdit = '<button type="button" class="btn p-0 mx-1 btn-edit" data-id="' . $row->id . '" title="Edit"><i class="fa-solid fa-pen-to-square text-success"></i></button>';
                    $btnHapus = '<button type="button" class="btn p-0 mx-1 btn-hapus" data-id="' . $row->id . '" title="Delete"><i class="fa-solid fa-trash-can text-danger"></i></button>';

                    return $btnEdit . $btnHapus;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.pages.kategori.index');
    }
    public function delete($id)
                {
                    $biodata = KategoriModel::find($id);
                    if ($biodata) {
                        $biodata->delete();
                        return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus.']);
                    } else {
                        return response()->json(['status' => 'error', 'message' => 'Data tidak ditemukan.']);
                    }
                }
    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'alamat' => 'required',
        ]);

        // $biodata = new BiodataModel();
        // $biodata->name = $request->name;
        // $biodata->email = $request->email;
        // $biodata->phone = $request->phone;
        // $biodata->alamat = $request->alamat;
        // $biodata->save();

        KategoriModel::create([
            'nama' => $request->name,
            'deskripsi' => $request->alamat,
        ]);

        Alert::success('Success', 'Data berhasil disimpan');
        return redirect()->back();
    }

    public function edit($id)
    {
        $kategori = KategoriModel::find($id);
        return response()->json([
            'id' => $kategori->id,
            'name' => $kategori->nama,
            'alamat' => $kategori->deskripsi
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'alamat' => 'required',
        ]);

        // $biodata = BiodataModel::find($request->id);
        // $biodata->name = $request->name;
        // $biodata->email = $request->email;
        // $biodata->phone = $request->phone;
        // $biodata->alamat = $request->alamat;
        // $biodata->save();

        KategoriModel::where('id', $request->id)->update([
            'nama' => $request->name,
            'deskripsi' => $request->alamat,

        ]);

        return response()->json(['status' => 'success', 'message' => 'Data berhasil diupdate.']);
    }

}
