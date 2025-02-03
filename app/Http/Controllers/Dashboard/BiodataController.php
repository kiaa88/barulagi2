<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\BiodataModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BiodataController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = [];

            $query = BiodataModel::query();
            // dd($query);

            $query->chunk(100, function ($biodataChunk) use (&$data) {
                foreach ($biodataChunk as $databiodata) {
                    $data[] = [
                        'id' => $databiodata->id ?? '',
                        'name' => $databiodata->name ?? '',
                        'email' => $databiodata->email ?? '',
                        'phone' => $databiodata->phone ?? '',
                        'alamat' => $databiodata->alamat ?? '',
                    ];
                }
            });

            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row['name'];
                })
                ->addColumn('email', function ($row) {
                    return $row['email'];
                })
                ->addColumn('phone', function ($row) {
                    return $row['phone'];
                })
                ->addColumn('alamat', function ($row) {
                    return $row['alamat'];
                })
                ->addColumn('action', function ($row) {
                    $btnEdit = '<button type="button" class="btn p-0 mx-1 btn-edit" data-id="' . $row['id'] . '" title="Edit"><i class="fa-solid fa-pen-to-square text-success"></i></button>';
                    $btnHapus = '<button type="button" class="btn p-0 mx-1 btn-hapus" data-id="' . $row['id'] . '" title="Delete"><i class="fa-solid fa-trash-can text-danger"></i></button>';

                    return $btnEdit . $btnHapus;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.pages.biodata.index');
    }
    public function delete($id)
                {
                    $biodata = BiodataModel::find($id);
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
            'email' => 'required',
            'phone' => 'required',
            'alamat' => 'required',
        ]);

        // $biodata = new BiodataModel();
        // $biodata->name = $request->name;
        // $biodata->email = $request->email;
        // $biodata->phone = $request->phone;
        // $biodata->alamat = $request->alamat;
        // $biodata->save();

        BiodataModel::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'alamat' => $request->alamat,
        ]);

        Alert::success('Success', 'Data berhasil disimpan');
        return redirect()->back();
    }

    public function edit($id)
    {
        $biodata = BiodataModel::find($id);
        return response()->json($biodata);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'alamat' => 'required',
        ]);

        // $biodata = BiodataModel::find($request->id);
        // $biodata->name = $request->name;
        // $biodata->email = $request->email;
        // $biodata->phone = $request->phone;
        // $biodata->alamat = $request->alamat;
        // $biodata->save();

        BiodataModel::where('id', $request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'alamat' => $request->alamat,
        ]);

        return response()->json(['status' => 'success', 'message' => 'Data berhasil diupdate.']);
    }

}
