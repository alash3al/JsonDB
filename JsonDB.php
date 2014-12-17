<?php

if ( ! ( class_exists('Horus_Container') && class_exists('Horus_Util') ) )
{
    die("<h4>Horus 9 must be installed, <a href='http://github.com/alash3al/Horus/releases/latest'>Download now, it is just one file</a></h4>");
}

/**
 * A json based flatfile database
 * @package     Horus Platform
 * @author      Mohammed Al Ashaal <http://is.gd/alash3al>
 * @copyright   2014
 * @access      public
 */
Class JsonDB extends Horus_Container
{
    /** @ignore */
    protected $file, $encrypt;

    /**
     * Constructor
     * @param   mixed $json_file
     * @return  self
     */
    public function __construct($json_file, $encrypt = null)
    {
        $data           =   array();
        $this->encrypt  =   $encrypt;

        if ( is_file($json_file) )
            $data = (array) @json_decode(($encrypt ? Horus::I()->util->decrypt(file_get_contents($json_file), $encrypt) : file_get_contents($json_file)), true);
        elseif ( ! is_writable($dir = dirname($json_file)) )
            throw new Horus_Exception("JsonDB, '{$dir}' is not writable");

        if ( ! is_file($json_file) )
            file_put_contents($json_file, json_encode(array()));

        parent::__construct($data);

        $this->file = $json_file;
    }

    /**
     * Commit changes
     * @return  self
     */
    public function commit()
    {
        file_put_contents($this->file, $this->encrypt ? Horus::I()->util->encrypt($this->serialize(), $this->encrypt) : $this->serialize());
        return $this;
    }
}
