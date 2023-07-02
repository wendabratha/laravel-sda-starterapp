<?php

namespace Modules\Admin\Http\Controllers\Dashboard;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Modules\Admin\Entities\Provinsi;
use Modules\Admin\Entities\Kabupaten;
use Illuminate\Http\Request;

class KabupatenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perKabupaten = 25;

        if (!empty($keyword)) {
            $kabupaten = Kabupaten::where('kabupaten', 'LIKE', "%$keyword%")
                ->latest()->paginate($perKabupaten);
        } else {
            $kabupaten = Kabupaten::latest()->paginate($perKabupaten);
        }

        return view('admin::dashboard.kabupaten.index', compact('kabupaten'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin::dashboard.kabupaten.create');
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
            'kabupaten_id' => 'required',
            'kabupaten' => 'required'
        ]);
        $requestData = $request->all();

        Kabupaten::create($requestData);

        return redirect()->route('admin.kabupaten.index')->with('success', __('kabupaten added!'));
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
        $kabupaten = Kabupaten::findOrFail($id);

        return view('admin::dashboard.kabupaten.show', compact('kabupaten'));
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
        $kabupaten = Kabupaten::findOrFail($id);

        return view('admin::dashboard.kabupaten.edit', compact('kabupaten'));
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
            'kabupaten_id' => 'required',
            'kabupaten' => 'required'
        ]);
        $requestData = $request->all();

        $kabupaten = Kabupaten::findOrFail($id);
        $kabupaten->update($requestData);

        return redirect()->route('admin.kabupaten.index')->with('success', __('Kabupaten updated!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return RedirectResponse|Redirector
     */
    public function destroy(Kabupaten $kabupaten)
    {
        if($kabupaten->kecamatan->count() > 0){
            session()->flash('error', "Data tidak bisa dihapus karena data $kabupaten->kabupaten terintegrasi data Kecamatan");
        }else{
            $kategori->delete();
            session()->flash('success', "Kabupaten : $kabupaten->kabupaten Berhasil Dihapus");
        }

        return redirect(route('admin.kabupaten.index'));
    }
}
