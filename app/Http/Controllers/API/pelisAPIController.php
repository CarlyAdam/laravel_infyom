<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatepelisAPIRequest;
use App\Http\Requests\API\UpdatepelisAPIRequest;
use App\Models\Pelis;
use App\Repositories\pelisRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class pelisController
 * @package App\Http\Controllers\API
 */

class pelisAPIController extends AppBaseController
{
    /** @var  pelisRepository */
    private $pelisRepository;

    public function __construct(pelisRepository $pelisRepo)
    {
        $this->pelisRepository = $pelisRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/pelis",
     *      summary="Get a listing of the pelis.",
     *      tags={"pelis"},
     *      description="Get all pelis",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/pelis")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->pelisRepository->pushCriteria(new RequestCriteria($request));
        $this->pelisRepository->pushCriteria(new LimitOffsetCriteria($request));
        $pelis = \App\Models\Pelis::with('cine')->get();

        return $this->sendResponse($pelis->toArray(), 'Pelis retrieved successfully');
    }

    /**
     * @param CreatepelisAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/pelis",
     *      summary="Store a newly created pelis in storage",
     *      tags={"pelis"},
     *      description="Store pelis",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="pelis that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/pelis")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/pelis"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatepelisAPIRequest $request)
    {
        $input = $request->all();

        $pelis = $this->pelisRepository->create($input);

        return $this->sendResponse($pelis->toArray(), 'Pelis saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/pelis/{id}",
     *      summary="Display the specified pelis",
     *      tags={"pelis"},
     *      description="Get pelis",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of pelis",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/pelis"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var pelis $pelis */
        $pelis = $this->pelisRepository->findWithoutFail($id);

        if (empty($pelis)) {
            return $this->sendError('Pelis not found');
        }

        return $this->sendResponse($pelis->toArray(), 'Pelis retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatepelisAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/pelis/{id}",
     *      summary="Update the specified pelis in storage",
     *      tags={"pelis"},
     *      description="Update pelis",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of pelis",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="pelis that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/pelis")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/pelis"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatepelisAPIRequest $request)
    {
        $input = $request->all();

        /** @var pelis $pelis */
        $pelis = $this->pelisRepository->findWithoutFail($id);

        if (empty($pelis)) {
            return $this->sendError('Pelis not found');
        }

        $pelis = $this->pelisRepository->update($input, $id);

        return $this->sendResponse($pelis->toArray(), 'pelis updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/pelis/{id}",
     *      summary="Remove the specified pelis from storage",
     *      tags={"pelis"},
     *      description="Delete pelis",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of pelis",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var pelis $pelis */
        $pelis = $this->pelisRepository->findWithoutFail($id);

        if (empty($pelis)) {
            return $this->sendError('Pelis not found');
        }

        $pelis->delete();

        return $this->sendResponse($id, 'Pelis deleted successfully');
    }
}
