<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatecinesAPIRequest;
use App\Http\Requests\API\UpdatecinesAPIRequest;
use App\Models\cines;
use App\Repositories\cinesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class cinesController
 * @package App\Http\Controllers\API
 */

class cinesAPIController extends AppBaseController
{
    /** @var  cinesRepository */
    private $cinesRepository;

    public function __construct(cinesRepository $cinesRepo)
    {
        $this->cinesRepository = $cinesRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/cines",
     *      summary="Get a listing of the cines.",
     *      tags={"cines"},
     *      description="Get all cines",
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
     *                  @SWG\Items(ref="#/definitions/cines")
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
        $this->cinesRepository->pushCriteria(new RequestCriteria($request));
        $this->cinesRepository->pushCriteria(new LimitOffsetCriteria($request));
        $cines = \App\Models\cines::with('pelis')->get();

        return $this->sendResponse($cines->toArray(), 'Cines retrieved successfully');
    }

    /**
     * @param CreatecinesAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/cines",
     *      summary="Store a newly created cines in storage",
     *      tags={"cines"},
     *      description="Store cines",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="cines that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/cines")
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
     *                  ref="#/definitions/cines"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatecinesAPIRequest $request)
    {
        $input = $request->all();

        $cines = $this->cinesRepository->create($input);

        return $this->sendResponse($cines->toArray(), 'Cines saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/cines/{id}",
     *      summary="Display the specified cines",
     *      tags={"cines"},
     *      description="Get cines",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of cines",
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
     *                  ref="#/definitions/cines"
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
        /** @var cines $cines */
        $cines = $this->cinesRepository->findWithoutFail($id);

        if (empty($cines)) {
            return $this->sendError('Cines not found');
        }

        return $this->sendResponse($cines->toArray(), 'Cines retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatecinesAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/cines/{id}",
     *      summary="Update the specified cines in storage",
     *      tags={"cines"},
     *      description="Update cines",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of cines",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="cines that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/cines")
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
     *                  ref="#/definitions/cines"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatecinesAPIRequest $request)
    {
        $input = $request->all();

        /** @var cines $cines */
        $cines = $this->cinesRepository->findWithoutFail($id);

        if (empty($cines)) {
            return $this->sendError('Cines not found');
        }

        $cines = $this->cinesRepository->update($input, $id);

        return $this->sendResponse($cines->toArray(), 'cines updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/cines/{id}",
     *      summary="Remove the specified cines from storage",
     *      tags={"cines"},
     *      description="Delete cines",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of cines",
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
        /** @var cines $cines */
        $cines = $this->cinesRepository->findWithoutFail($id);

        if (empty($cines)) {
            return $this->sendError('Cines not found');
        }

        $cines->delete();

        return $this->sendResponse($id, 'Cines deleted successfully');
    }
}
