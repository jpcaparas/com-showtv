<?php

class ShowTV_API_TMDB_Base
{
  /**
   * @var Tmdb\Client
   */
  protected $tmdb_client;

  /**
   * ShowTV_API_TMDB_Base constructor.
   *
   * @param null|string $api_token
   *
   * @throws ShowTV_API_TMDB_Base_Exception
   */
  public function __construct($api_token = null)
  {
    if ($api_token == '') {
      $api_token = showtv_tmdb_get_option('api_key');
      if ($api_token == '') {
        throw new ShowTV_API_TMDB_Base_Exception('Please set the TMDB API key option value.');
      }
    }

    $api_token = new Tmdb\ApiToken($api_token);
    $this->tmdb_client = new Tmdb\Client($api_token);
  }
}

class ShowTV_API_TMDB_Base_Exception extends Exception
{
}