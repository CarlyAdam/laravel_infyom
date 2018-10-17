<?php

namespace App\Repositories;

use App\Models\cines;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class cinesRepository
 * @package App\Repositories
 * @version July 17, 2018, 9:40 pm UTC
 *
 * @method cines findWithoutFail($id, $columns = ['*'])
 * @method cines find($id, $columns = ['*'])
 * @method cines first($columns = ['*'])
*/
class cinesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'direccion_lat',
        'direccion_long',
        'website'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return cines::class;
    }
}
