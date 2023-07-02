<?php

namespace Modules\Admin\Http\Controllers\Dashboard;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Http\Request;

use Modules\Admin\Entities\Kategori;

use Modules\Admin\Entities\Provinsi;
use Modules\Admin\Entities\Kabupaten;
use Modules\Admin\Entities\Kecamatan;
use Modules\Admin\Entities\Kelurahan;

use Modules\Admin\Entities\Potensisda;

class PotensisdaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPotensisda = 25;

        if (!empty($keyword)) {
            $potensisda = Potensisda::where('potensisda', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPotensisda);
        } else {
            $potensisda = Potensisda::orderBy('id', 'ASC')->paginate($perPotensisda);
        }

        return view('admin::dashboard.potensisda.index', compact('potensisda'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $kategori = Kategori::all();
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::all();

        return view('admin::dashboard.potensisda.create', compact('kategori', 'kecamatan', 'kelurahan'));
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
            'geom' => 'required',
            'kategori_id' => 'required',
            'kecamatan_kecamatan_id' => 'required',
            'kelurahan_kelurahan_id' => 'required',
            'nama' => 'required',
            'deskripsi' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'video' => 'required|mimes:mp4,ogx,oga,ogv,ogg,webm|max:2048'
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('img/images'), $imageName);

        // $requestData = $request->all();

        // Potensisda::create($requestData);

        $potensisda = new Potensisda;
        $potensisda->image = $imageName;
        $potensisda->geom = $request->geom;
        $potensisda->kategori_id = $request->kategori_id;
        $potensisda->kecamatan_kecamatan_id = $request->kecamatan_kecamatan_id;
        $potensisda->kelurahan_kelurahan_id = $request->kelurahan_kelurahan_id;
        $potensisda->nama = $request->nama;
        $potensisda->deskripsi = $request->deskripsi;
        $potensisda->save();

        // return redirect()->route('admin.potensisda.index')->with('success', __('Potensisda added!'));

        return redirect()->route('admin.potensisda.index')->with('success', 'Potensisda added!');
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
        $potensisda = Potensisda::findOrFail($id);

        return view('admin::dashboard.potensisda.show', compact('potensisda'));
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
        $kategori = Kategori::all();
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::all();
        $potensisda = Potensisda::findOrFail($id);

        return view('admin::dashboard.potensisda.edit', compact('potensisda', 'kategori', 'kecamatan', 'kelurahan'));
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
            'geom' => 'required',
            'kategori_id' => 'required',
            'kecamatan_kecamatan_id' => 'required',
            'kelurahan_kelurahan_id' => 'required',
            'nama' => 'required',
            'deskripsi' => 'required'
        ]);
        $requestData = $request->all();

        $potensisda = Potensisda::findOrFail($id);
        $potensisda->update($requestData);

        return redirect()->route('admin.potensisda.index')->with('success', __('Potensisda updated!'));
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
        Potensisda::destroy($id);

        return redirect()->route('admin.potensisda.index')->with('success', __('Potensisda deleted!'));
    }

}
