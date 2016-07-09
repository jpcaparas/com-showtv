<?php

class ShowTV_API_TMDB_Search extends ShowTV_API_TMDB_Base
{
    /**
     * @var \Tmdb\Api\Search
     */
    protected $search_api;

    /**
     * ShowTV_API_TDMB_Search constructor.
     * @param null|string $api_token
     */
    public function __construct($api_token = null)
    {
        parent::__construct($api_token);
        $this->search_api = $this->tmdb_client->getSearchApi();
    }

    /**
     * Search for TV shows
     *
     * @param null $query
     * @param array $parameters
     *
     * @return mixed $results
     */
    public function search_tv($query = null, $parameters = array())
    {
        $results = $this->search_api->searchTv($query, $parameters);

        return $results;
    }
}