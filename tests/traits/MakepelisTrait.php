<?php

use Faker\Factory as Faker;
use App\Models\Pelis;
use App\Repositories\pelisRepository;

trait MakepelisTrait
{
    /**
     * Create fake instance of pelis and save it in database
     *
     * @param array $pelisFields
     * @return pelis
     */
    public function makepelis($pelisFields = [])
    {
        /** @var pelisRepository $pelisRepo */
        $pelisRepo = App::make(pelisRepository::class);
        $theme = $this->fakepelisData($pelisFields);
        return $pelisRepo->create($theme);
    }

    /**
     * Get fake instance of pelis
     *
     * @param array $pelisFields
     * @return pelis
     */
    public function fakepelis($pelisFields = [])
    {
        return new pelis($this->fakepelisData($pelisFields));
    }

    /**
     * Get fake data of pelis
     *
     * @param array $postFields
     * @return array
     */
    public function fakepelisData($pelisFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'cines_id' => $fake->randomDigitNotNull,
            'categorias_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'nombre' => $fake->word,
            'descripcion' => $fake->word,
            'director' => $fake->word,
            'fecha' => $fake->word,
            'foto' => $fake->word,
            'trailer' => $fake->word,
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $pelisFields);
    }
}
