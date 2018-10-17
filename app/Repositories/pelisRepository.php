<?php

namespace App\Repositories;

use App\Models\Pelis;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class pelisRepository
 * @package App\Repositories
 * @version July 17, 2018, 9:46 pm UTC
 *
 * @method pelis findWithoutFail($id, $columns = ['*'])
 * @method pelis find($id, $columns = ['*'])
 * @method pelis first($columns = ['*'])
*/
class pelisRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'cines_id',
        'nombre',
        'descripcion'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return pelis::class;
    }
}
