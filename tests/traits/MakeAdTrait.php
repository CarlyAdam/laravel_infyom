<?php

use Faker\Factory as Faker;
use App\Models\Ad;
use App\Repositories\AdRepository;

trait MakeAdTrait
{
    /**
     * Create fake instance of Ad and save it in database
     *
     * @param array $adFields
     * @return Ad
     */
    public function makeAd($adFields = [])
    {
        /** @var AdRepository $adRepo */
        $adRepo = App::make(AdRepository::class);
        $theme = $this->fakeAdData($adFields);
        return $adRepo->create($theme);
    }

    /**
     * Get fake instance of Ad
     *
     * @param array $adFields
     * @return Ad
     */
    public function fakeAd($adFields = [])
    {
        return new Ad($this->fakeAdData($adFields));
    }

    /**
     * Get fake data of Ad
     *
     * @param array $postFields
     * @return array
     */
    public function fakeAdData($adFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'precio' => $fake->word,
            'titulo' => $fake->word,
            'contenido' => $fake->word,
            'foto' => $fake->word,
            'user_id' => $fake->word,
            'category_id' => $fake->word
        ], $adFields);
    }
}
