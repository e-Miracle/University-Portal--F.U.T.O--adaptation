<?php
/**
 * Chibuzo Ebubechi Miracle
 * All right reserved.
 * Copyright (c) 2020.
 */

namespace core\middlewares;


class File
{
    private array $_error = [];
    private $destination;
    private array $check;
    private bool $its_multiple;

    /**
     * @var mixed
     */
    private $file;

    public function __construct($file = [], $check = [], $destination = DEFAULT_FILE_DESTINATION)
    {
        //get the file input name possibly
        $key = array_key_first($file);
        $this->file = $file[$key];
        //store check values in class
        $this->check = $check;
        //store destination folder in class
        $this->destination = $destination;
        //determine if the file passed in is multiple or single file
        (is_array($this->file['name']))? $this->its_multiple = true : $this->its_multiple = false;
    }

    private function validate()
    {
        $this->_error = [];
        if (empty($this->check)) {
            throw new \Exception("Please enter file check you wish to verify ", 500);
        }

        if (!is_dir($this->destination)) {
            throw new \Exception("Destination is not valid ".$this->destination, 500);
        }

        switch ($this->its_multiple) {
            case true:
                for ($i=0; $i < count($this->file['name']); $i++) {
                    if (array_key_exists('max_size', $this->check)) {
                        $size = preg_replace("/[^0-9.]/", "", $this->check['max_size']);
                        //convert size in mb to byte
                        $size = $size * 10 ** 6;

                        //check if the max_size of input is valid
                        if ($this->file['size'][$i] > $size) {
                            $this->_error[] = 'Please select an image less than '. $this->check['max_size'].' in size';
                        }
                    }

                    if (array_key_exists('min_size', $this->check)) {
                        $size = preg_replace("/[^0-9.]/", "", $this->check['min_size']);
                        //convert size in mb to byte
                        $size = $size * 10 ** 6;

                        //check if the max_size of input is valid
                        if ($this->file['size'][$i] < $size) {
                            $this->_error[] = 'Please select an image more than '. $this->check['min_size'].' in size';
                        }
                    }

                    if (array_key_exists('type', $this->check)) {
                        if (!in_array(strtolower(pathinfo($this->file['name'][$i],PATHINFO_EXTENSION)), $this->check['type'])) {
                            $this->_error[]= 'Please select an image with any of these image formats '. extract($this->check['type']);
                        }
                    }else {
                        throw new \Exception("No extension type selected ", 500);
                    }
                }
                break;

            default:
                if (array_key_exists('max_size', $this->check)) {
                    $size = preg_replace("/[^0-9.]/", "", $this->check['max_size']);
                    //convert size in mb to byte
                    $size = $size * 10 ** 6;

                    //check if the max_size of input is valid
                    if ($this->file['size'] > $size) {
                        $this->_error[] = 'Please select an image less than '. $this->check['max_size'].' in size';
                    }
                }

                if (array_key_exists('min_size', $this->check)) {

                    $size = preg_replace("/[^0-9.]/", "", $this->check['min_size']);
                    //convert size in mb to byte
                    $size = $size * 10 ** 6;

                    //check if the min_size of input is valid
                    if ($this->file['size'] < $size) {
                        $this->_error[] = 'Please select an image more than '. $this->check['min_size'].' in size';
                    }
                }

                if (array_key_exists('type', $this->check)) {
                    if (!in_array(strtolower(pathinfo($this->file['name'],PATHINFO_EXTENSION)), $this->check['type'])) {
                        $this->_error[]= 'Please select an image with any of these image formats '. extract($this->check['type']);
                    }
                }else {
                    throw new \Exception("No extension type selected ", 500);
                }
                break;
        }
    }

    //returning errors//
    public function errors()
    {
        return $this->_error;
    }

    public function upload()
    {
        try {
            $this->validate();
        } catch (\Exception $e) {
            throw new \Exception("Couldn't validate file", 500);
        }
        if (empty($this->_error)) {

            switch ($this->its_multiple) {
                case true:
                    $image = new \stdClass();
                    for($i=0 ; $i < count($this->file['name']) ; $i++) {
                        $file_name = $this->getFileName($this->file['name'][$i]);
                        if (move_uploaded_file($this->file['tmp_name'][$i], $this->destination.$file_name)) {
                            $image->{$i} = $this->destination.$file_name;
                        }else {
                            throw new \Exception("Couldn't upload file", 500);
                        }
                    }
                    break;

                default:
                    $file_name = $this->getFileName($this->file['name']);
                    if (move_uploaded_file($this->file['tmp_name'], $this->destination.$file_name)) {
                        $image = $this->destination.$file_name;
                    }else {
                        throw new \Exception("Couldn't upload file", 500);
                    }
                    break;
            }
            return $image;
        }
        return false;
    }

    private function getFileName($__filename)
    {
        /**
         * for sake of RFI and LFI attacks we would be
         * changing the file name of whatever file being uploaded
         * we would do this by getting current timestamp and random byte characters
         * then rename the file with it
         */

        return Time::now().bin2hex(random_bytes(5)).str_replace(' ', '', $__filename);
    }
}