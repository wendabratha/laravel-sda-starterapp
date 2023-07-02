<?php

namespace Modules\Admin\Http\Controllers\Dashboard;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Modules\Admin\Entities\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perKategori = 25;

        if (!empty($keyword)) {
            $kategori = Kategori::where('nama_kategori', 'LIKE', "%$keyword%")
                ->latest()->paginate($perKategori);
        } else {
            $kategori = Kategori::orderBy('id', 'ASC')->paginate($perKategori);
        }

        return view('admin::dashboard.kategori.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin::dashboard.kategori.create');
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
            'nama_kategori' => 'required'
        ]);
        $requestData = $request->all();

        Kategori::create($requestData);

        return redirect()->route('admin.kategori.index')->with('success', __('Kategori added!'));
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
        $kategori = Kategori::findOrFail($id);

        return view('admin::dashboard.kategori.show', compact('kategori'));
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
        $kategori = Kategori::findOrFail($id);

        return view('admin::dashboard.kategori.edit', compact('kategori'));
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
            'nama_kategori' => 'required'
        ]);
        $requestData = $request->all();

        $kategori = Kategori::findOrFail($id);
        $kategori->update($requestData);

        return redirect()->route('admin.kategori.index')->with('success', __('Kategori updated!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        Kategori::destroy($id);

        return redirect()->route('admin.kategori.index')->with('success', __('Kategori deleted!'));
    }
}
