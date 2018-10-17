<?php

use Faker\Factory as Faker;
use App\Models\Cine;
use App\Repositories\CineRepository;

trait MakeCineTrait
{
    /**
     * Create fake instance of Cine and save it in database
     *
     * @param array $cineFields
     * @return Cine
     */
    public function makeCine($cineFields = [])
    {
        /** @var CineRepository $cineRepo */
        $cineRepo = App::make(CineRepository::class);
        $theme = $this->fakeCineData($cineFields);
        return $cineRepo->create($theme);
    }

    /**
     * Get fake instance of Cine
     *
     * @param array $cineFields
     * @return Cine
     */
    public function fakeCine($cineFields = [])
    {
        return new Cine($this->fakeCineData($cineFields));
    }

    /**
     * Get fake data of Cine
     *
     * @param array $postFields
     * @return array
     */
    public function fakeCineData($cineFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nombre' => $fake->word,
            'butacas' => $fake->randomDigitNotNull
        ], $cineFields);
    }
}
