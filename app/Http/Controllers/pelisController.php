<?php

namespace App\Http\Controllers;

use App\DataTables\pelisDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatepelisRequest;
use App\Http\Requests\UpdatepelisRequest;
use App\Repositories\pelisRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Http\Controllers\Controller;
use App\Models\Pelis;
use App\Models\cines;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class pelisController extends AppBaseController
{
    /** @var  pelisRepository */
    private $pelisRepository;

    public function __construct(pelisRepository $pelisRepo)
    {
        $this->pelisRepository = $pelisRepo;
    }

    /**
     * Display a listing of the pelis.
     *
     * @param pelisDataTable $pelisDataTable
     * @return Response
     */
    public function index(pelisDataTable $pelisDataTable)
    {
        return $pelisDataTable->render('pelis.index');
    }

    /**
     * Show the form for creating a new pelis.
     *
     * @return Response
     */
    public function create()
    {

        $cines = cines::all();

    foreach ($cines as $cines) {

        $cinesArray[$cines->id] = $cines->nombre;

    }

        return view('pelis.create',compact('categoriasArray','cinesArray'));
    }


    /**
     * Store a newly created pelis in storage.
     *
     * @param CreatepelisRequest $request
     *
     * @return Response
     */
    public function store(CreatepelisRequest $request)
    {
        $input = $request->all();

        $pelis = $this->pelisRepository->create($input);

        Flash::success('Pelis saved successfully.');

        return redirect(route('pelis.index'));
    }

    /**
     * Display the specified pelis.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pelis = $this->pelisRepository->findWithoutFail($id);

        if (empty($pelis)) {
            Flash::error('Pelis not found');

            return redirect(route('pelis.index'));
        }

        return view('pelis.show')->with('pelis', $pelis);
    }

    /**
     * Show the form for editing the specified pelis.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pelis = $this->pelisRepository->findWithoutFail($id);

        $cines = cines::all();


    foreach ($cines as $cines) {

        $cinesArray[$cines->id] = $cines->nombre;

    }

        if (empty($pelis)) {
            Flash::error('Pelis not found');

            return redirect(route('pelis.index'));
        }

        return view('pelis.edit',compact('categoriasArray','cinesArray'))->with('pelis', $pelis);
    }

    /**
     * Update the specified pelis in storage.
     *
     * @param  int              $id
     * @param UpdatepelisRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepelisRequest $request)
    {
        $pelis = $this->pelisRepository->findWithoutFail($id);

        if (empty($pelis)) {
            Flash::error('Pelis not found');

            return redirect(route('pelis.index'));
        }

        $pelis = $this->pelisRepository->update($request->all(), $id);

        Flash::success('Pelis updated successfully.');

        return redirect(route('pelis.index'));
    }

    /**
     * Remove the specified pelis from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pelis = $this->pelisRepository->findWithoutFail($id);

        if (empty($pelis)) {
            Flash::error('Pelis not found');

            return redirect(route('pelis.index'));
        }

        $this->pelisRepository->delete($id);

        Flash::success('Pelis deleted successfully.');

        return redirect(route('pelis.index'));
    }
}
