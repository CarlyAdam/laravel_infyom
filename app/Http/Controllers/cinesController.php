<?php

namespace App\Http\Controllers;

use App\DataTables\cinesDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatecinesRequest;
use App\Http\Requests\UpdatecinesRequest;
use App\Repositories\cinesRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class cinesController extends AppBaseController
{
    /** @var  cinesRepository */
    private $cinesRepository;

    public function __construct(cinesRepository $cinesRepo)
    {
        $this->cinesRepository = $cinesRepo;
    }

    /**
     * Display a listing of the cines.
     *
     * @param cinesDataTable $cinesDataTable
     * @return Response
     */
    public function index(cinesDataTable $cinesDataTable)
    {
        return $cinesDataTable->render('cines.index');
    }

    /**
     * Show the form for creating a new cines.
     *
     * @return Response
     */
    public function create()
    {
        return view('cines.create');
    }

    /**
     * Store a newly created cines in storage.
     *
     * @param CreatecinesRequest $request
     *
     * @return Response
     */
    public function store(CreatecinesRequest $request)
    {
        $input = $request->all();

        $cines = $this->cinesRepository->create($input);

        Flash::success('Cines saved successfully.');

        return redirect(route('cines.index'));
    }

    /**
     * Display the specified cines.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cines = $this->cinesRepository->findWithoutFail($id);

        if (empty($cines)) {
            Flash::error('Cines not found');

            return redirect(route('cines.index'));
        }

        return view('cines.show')->with('cines', $cines);
    }

    /**
     * Show the form for editing the specified cines.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cines = $this->cinesRepository->findWithoutFail($id);

        if (empty($cines)) {
            Flash::error('Cines not found');

            return redirect(route('cines.index'));
        }

        return view('cines.edit')->with('cines', $cines);
    }

    /**
     * Update the specified cines in storage.
     *
     * @param  int              $id
     * @param UpdatecinesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecinesRequest $request)
    {
        $cines = $this->cinesRepository->findWithoutFail($id);

        if (empty($cines)) {
            Flash::error('Cines not found');

            return redirect(route('cines.index'));
        }

        $cines = $this->cinesRepository->update($request->all(), $id);

        Flash::success('Cines updated successfully.');

        return redirect(route('cines.index'));
    }

    /**
     * Remove the specified cines from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cines = $this->cinesRepository->findWithoutFail($id);

        if (empty($cines)) {
            Flash::error('Cines not found');

            return redirect(route('cines.index'));
        }

        $this->cinesRepository->delete($id);

        Flash::success('Cines deleted successfully.');

        return redirect(route('cines.index'));
    }
}
