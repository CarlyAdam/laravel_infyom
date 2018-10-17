<?php

use Faker\Factory as Faker;
use App\Models\cines;
use App\Repositories\cinesRepository;

trait MakecinesTrait
{
    /**
     * Create fake instance of cines and save it in database
     *
     * @param array $cinesFields
     * @return cines
     */
    public function makecines($cinesFields = [])
    {
        /** @var cinesRepository $cinesRepo */
        $cinesRepo = App::make(cinesRepository::class);
        $theme = $this->fakecinesData($cinesFields);
        return $cinesRepo->create($theme);
    }

    /**
     * Get fake instance of cines
     *
     * @param array $cinesFields
     * @return cines
     */
    public function fakecines($cinesFields = [])
    {
        return new cines($this->fakecinesData($cinesFields));
    }

    /**
     * Get fake data of cines
     *
     * @param array $postFields
     * @return array
     */
    public function fakecinesData($cinesFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nombre' => $fake->word,
            'butacas' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $cinesFields);
    }
}
