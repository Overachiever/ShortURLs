<?php
/**
 * Created by PhpStorm.
 * User: sjohnson
 * Date: 9/14/2014
 * Time: 5:48 PM
 */

class Links_model extends MY_Model
{
    protected $primary_key = 'link_id';

    public $before_create = array( 'created_on', 'updated_on', 'generate_code' );
    public $before_update = array( 'updated_on' );

    public $validate = array(
        array(
            'field' => 'url',
            'label' => 'url',
            'rules' => 'required|valid_url'
        )
    );

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Creates a link and returns the created record
     * @param array $data
     * @return array
     */
    public function create($data)
    {
        //don't create a new record if url already exists
        $result = $this->get_by('url', $data['url']);

        if(empty($result))
        {
            $id = $this->insert($data);
            $result = $this->get($id);
        }

        return $result;
    }

    /**
     * Generates a unique short code for a URL.  Takes in the recordset being inserted.
     * @param array $link
     * @return array
     */
    protected function generate_code($link)
    {
        //setup code configuration
        $validCharacters = 'abcdefghijklmnopqrstuvwxyz1234567890';
        $minimumLength = 5;
        $maximumLength = 9;

        $validCode = false;

        $urlCode = '';

        //loop until code is valid and unique
        while(!$validCode)
        {
            $currentLength = strlen($urlCode);

            $urlCode .= $validCharacters[rand(0, strlen($validCharacters)-1)];

            //check for duplicate
            if($currentLength >= $minimumLength && $currentLength <= $maximumLength)
            {
                $result = $this->get($urlCode);

                if(empty($result))
                {
                    $validCode = true;
                }
            }
            //won the lottery by generating two of the same codes after 9 characters, reset code and start over.
            else if($currentLength > $maximumLength)
            {
                $urlCode = '';
            }
        }

        $link['url_code'] = $urlCode;

        return $link;
    }
}
