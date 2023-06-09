<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\LogActivity;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $members = Member::when($search, function ($query, $search) {
               return $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('tlp', 'like', "%{$search}%");
            })
            ->paginate();

        if ($search) {
            $members->appends(['search' => $search]);
        }

        return view('member.index', [
            'members' => $members,
        ]);
    }


    public function create()
    {
        return view('member.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|max:250',
            'tlp' => 'required|numeric'
        ], [], [
            'tlp' => 'Telepon'
        ]);

        Member::create($request->all());

        LogActivity::add('berhasil menambah member');
        return redirect()->route('member.index')
            ->with('message', 'success store');
    }


    public function show(Member $member)
    {
        return abort(404);
    }


    public function edit(Member $member)
    {
        return view('member.edit', [
            'member' => $member,
        ]);
    }


    public function update(Request $request, Member $member)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|max:250',
            'tlp' => 'required|numeric'
        ], [], [
            'tlp' => 'Telepon'
        ]);

        $member->update($request->all());

        LogActivity::add('berhasil mengupdate memebr');
        return redirect()->route('member.index')
            ->with('message', 'success update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        $member->delete();
        LogActivity::add('berhasil menghapus member');
        return back()->with('message', 'success delete');
    }
}
