<?php

namespace Modules\Admin\Http\Controllers\Dashboard;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Modules\Admin\Entities\Provinsi;
use Modules\Admin\Entities\Kecamatan;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $keyword = $request->get('search');
        $perKecamatan = 25;

        if (!empty($keyword)) {
            $kecamatan = Kecamatan::where('title', 'LIKE', "%$keyword%")
                ->orWhere('content', 'LIKE', "%$keyword%")
                ->latest()->paginate($perKEcamatan);
        } else {
            $kecamatan = Kecamatan::orderBy('id', 'ASC')->paginate($perKecamatan);
        }

        return view('admin::dashboard.kecamatan.index', compact('kecamatan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin::dashboard.kecamatan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kecamatan_id' => 'required',
            'kecamatan' => 'required'
        ]);
        $requestData = $request->all();

        Kecamatan::create($requestData);

        return redirect()->route('admin.kecamatan.index')->with('success', __('Kecamatan added!'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return View
     */
    public function show(int $id): View
    {
        $kecamatan = Kecamatan::findOrFail($id);

        return view('admin::dashboard.kecamatan.show', compact('kecamatan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return View
     */
    public function edit(int $id): View
    {
        $kecamatan = Kecamatan::findOrFail($id);

        return view('admin::dashboard.kecamatan.edit', compact('kecamatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     *
     * @return RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function update(Request $request, int $id)
    {
        $this->validate($request, [
            'kecamatan_id' => 'required',
            'kecamatan' => 'required'
        ]);
        $requestData = $request->all();

        $kecamatan = Kecamatan::findOrFail($id);
        $kecamatan->update($requestData);

        return redirect()->route('admin.kecamatan.index')->with('success', __('Kecamatan updated!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return RedirectResponse|Redirector
     */
    public function destroy(Kecamatan $kecamatan)
    {
        if($kecamatan->kelurahan->count() > 0){
            session()->flash('error', "Data tidak bisa dihapus karena data $kecamatan->kecamatan terintegrasi data Kelurahan/Desa");
        }else{
            $kategori->delete();
            session()->flash('success', "Kabupaten : $kecamatan->kecamatan Berhasil Dihapus");
        }

        return redirect(route('admin.kecamatan.index'));
    }
}

