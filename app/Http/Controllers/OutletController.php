<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use Illuminate\Http\Request;
use App\Models\LogActivity;

class OutletController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $outlets = Outlet::when($search, function ($query, $search) {
               return $query->where('nama', 'like', "%{$search}%")
                   ->orWhere('tlp', 'like', "%{$search}%");
            })
            ->paginate();

        if ($search) {
            $outlets->appends(['search' => $search]);
        }

        return view('outlet.index', [
            'outlets' => $outlets,
        ]);
    }


    public function create()
    {
        return view('outlet.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'tlp' => 'required|max:20',
            'alamat' => 'required|max:250',
        ], [], [
            'tlp' => 'Telepon'
        ]);

        Outlet::create($request->all());

        LogActivity::add('berhasil menambah outlet');
        return redirect()->route('outlet.index')
            ->with('message', 'success store');
    }


    public function show(Outlet $outlet)
    {
        return abort(404);
    }


    public function edit(Outlet $outlet)
    {
        return view('outlet.edit', [
            'outlet' => $outlet
        ]);
    }


    public function update(Request $request, Outlet $outlet)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'tlp' => 'required|max:20',
            'alamat' => 'required|max:250',
        ], [], [
            'tlp' => 'Telepon'
        ]);

        $outlet->update($request->all());

        LogActivity::add('berhasil mengupdate outlet');
        return redirect()->route('outlet.index')
            ->with('message', 'success update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outlet $outlet)
    {
        $outlet->delete();
        LogActivity::add('berhasil menghapus outlet');
        return back()->with('message', 'success delete');
    }
}
