<?php

class ShowTV_API_Youtube
{
    /**
     * @var \Madcoda\Youtube
     */
    protected $youtube_client;

    public function __construct($api_token = null)
    {
        if ($api_token == '') {
            $options = get_option('showtv_youtube', array());

            if (empty($options['api_key'])) {
                throw new ShowTV_API_Youtube_Exception('Please set the YouTube API key option value.');
            }

            $api_token = $options['api_key'];
        }

        $params = array(
            'key' => $api_token
        );

        $this->youtube_client = new Madcoda\Youtube($params);
    }

    /**
     * @param string $term
     * @param int $max_results
     *
     * @return array
     */
    public function search($term, $max_results = 10)
    {
        return $this->youtube_client->search($term, $max_results);
    }
}

class ShowTV_API_Youtube_Exception extends Exception
{
}