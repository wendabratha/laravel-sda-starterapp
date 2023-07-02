<?php

namespace Modules\Admin\Http\Controllers\Dashboard;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Http\Request;

use Modules\Admin\Entities\Provinsi;
use Modules\Admin\Entities\Kabupaten;
use Modules\Admin\Entities\Kecamatan;
use Modules\Admin\Entities\Kelurahan;

class KelurahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perKelurahan = 25;

        if (!empty($keyword)) {
            $kelurahan = Kelurahan::where('kelurahan', 'LIKE', "%$keyword%")
                ->latest()->paginate($perKelurahan);
        } else {
            $kelurahan = Kelurahan::orderBy('id', 'ASC')->paginate($perKelurahan);
        }

        return view('admin::dashboard.kelurahan.index', compact('kelurahan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin::dashboard.kelurahan.create');
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
            'kelurahan_id' => 'required',
            'kelurahan' => 'required'
        ]);
        $requestData = $request->all();

        Kelurahan::create($requestData);

        return redirect()->route('admin.kelurahan.index')->with('success', __('Kelurahan added!'));
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
        $kelurahan = Kelurahan::findOrFail($id);

        return view('admin::dashboard.kelurahan.show', compact('kelurahan'));
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
        $kelurahan = Kelurahan::findOrFail($id);

        return view('admin::dashboard.kelurahan.edit', compact('kelurahan'));
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
            'kelurahan_id' => 'required',
            'kelurahan' => 'required'
        ]);
        $requestData = $request->all();

        $kelurahan = Kelurahan::findOrFail($id);
        $kelurahan->update($requestData);

        return redirect()->route('admin.kelurahan.index')->with('success', __('Kelurahan updated!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return RedirectResponse|Redirector
     */
    public function destroy(int $id)
    {
        Kelurahan::destroy($id);

        return redirect()->route('admin.kelurahan.index')->with('success', __('Kelurahan deleted!'));
    }
}
