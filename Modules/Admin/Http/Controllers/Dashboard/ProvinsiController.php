<?php

namespace Modules\Admin\Http\Controllers\Dashboard;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Modules\Admin\Entities\Provinsi;
use Illuminate\Http\Request;

class ProvinsiController extends Controller
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
        $perProvinsi = 25;

        if (!empty($keyword)) {
            $provinsi = Provinsi::where('provinsi', 'LIKE', "%$keyword%")
                ->latest()->paginate($perProvinsi);
        } else {
            $provinsi = Provinsi::latest()->paginate($perProvinsi);
        }

        return view('admin::dashboard.provinsi.index', compact('provinsi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin::dashboard.provinsi.create');
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
            'provinsi_id' => 'required',
            'provinsi' => 'required'
        ]);
        $requestData = $request->all();

        Provinsi::create($requestData);

        return redirect()->route('admin.provinsi.index')->with('success', __('Provinsi added!'));
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
        $provinsi = Provinsi::findOrFail($id);

        return view('admin::dashboard.provinsi.show', compact('provinsi'));
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
        $provinsi = Provinsi::findOrFail($id);

        return view('admin::dashboard.provinsi.edit', compact('provinsi'));
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
            'provinsi_id' => 'required',
            'provinsi' => 'required'
        ]);
        $requestData = $request->all();

        $provinsi = Provinsi::findOrFail($id);
        $provinsi->update($requestData);

        return redirect()->route('admin.provinsi.index')->with('success', __('Provinsi updated!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return RedirectResponse|Redirector
     */
    public function destroy(Provinsi $provinsi)
    {
        if($provinsi->kabupaten->count() > 0){
            session()->flash('error', "Data tidak bisa dihapus karena data $provinsi->provinsi terintegrasi data Kabupaten");
        }else{
            $provinsi->delete();
            session()->flash('success', "Kabupaten : $provinsi->provinsi Berhasil Dihapus");
        }

        return redirect(route('admin.provinsi.index'));
    }
}
