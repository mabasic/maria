<?php

namespace Mabasic\Maria;

use Intervention\Image\ImageManagerStatic as Image;

class Maria
{
    protected $input_directory;
    protected $output_directory;
    protected $prefix = null;

    public function __construct($input_directory, $output_directory)
    {
        $this->input_directory = $input_directory;
        $this->output_directory = $output_directory;

        ini_set('memory_limit', '1024M');
    }

    public function addPrefix($prefix = null)
    {
        $this->prefix = "thumb_";

        if(!is_null($prefix))
        {
            $this->prefix = $prefix;
        }

        return $this;
    }

    protected function getFiles($directory)
    {
        return array_diff(scandir($directory), ['.', '..']);
    }

    public function fit($width, $height)
    {
        foreach($this->getFiles($this->input_directory) as $filename)
        {
            $image = $this->makeImage($filename);

            $image->fit($width, $height);

            $this->saveImage($image, $this->getFilename($filename));
        }
    }

    protected function makeImage($filename)
    {
        return Image::make("{$this->input_directory}/{$filename}");
    }

    protected function saveImage($image, $filename)
    {
        $image->save("{$this->output_directory}/{$filename}");
    }

    protected function getFilename($filename)
    {
        return "{$this->prefix}{$filename}";
    }


}
