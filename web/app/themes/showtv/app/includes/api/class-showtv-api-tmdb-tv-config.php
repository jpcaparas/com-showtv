<?php

class ShowTV_API_TMDB_TV_Config extends ShowTV_API_TMDB_Base
{
    /**
     * @var \Tmdb\Api\Configuration
     */
    private $configuration_api;

    /**
     * @var mixed
     */
    private $configuration;

    /**
     * ShowTV_API_TDMB_Search constructor.
     * @param null|string $api_token
     */
    public function __construct($api_token = null)
    {
        parent::__construct($api_token);
        $this->configuration_api = $this->tmdb_client->getConfigurationApi();
        $this->configuration = $this->configuration_api->getConfiguration();
    }

    /**
     * @return \Tmdb\Api\Configuration
     */
    public function get_configuration_api()
    {
        return $this->configuration_api;
    }

    /**
     * @return mixed
     */
    public function get_configuration()
    {
        return $this->configuration;
    }
}