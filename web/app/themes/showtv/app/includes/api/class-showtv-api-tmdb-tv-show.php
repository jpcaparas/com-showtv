<?php

class ShowTV_API_TMDB_TV_Show extends ShowTV_API_TMDB_Base
{
    /**
     * @var \Tmdb\Api\Tv
     */
    protected $tv_api;

    /**
     * ShowTV_API_TDMB_Search constructor.
     * @param null|string $api_token
     */
    public function __construct($api_token = null)
    {
        parent::__construct($api_token);
        $this->tv_api = $this->tmdb_client->getTvApi();
    }

    /**
     * Gets a TV show by it's ID
     *
     * @param null $tvshow_id
     * @param array $parameters
     *
     * @return mixed $results
     */
    public function get($tvshow_id, $parameters = array())
    {
        $results = $this->tv_api->getTvshow($tvshow_id, $parameters);

        return $results;
    }
}