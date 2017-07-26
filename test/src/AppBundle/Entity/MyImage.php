<?php

namespace AppBundle\Entity;

use Symfony\Component\HttpFoundation\File\File;

class MyImage
{
    private $data;
    private $mimeType;

    public static function createFromFile(File $file)
    {
        $myimage = new self();
        $myimage
            ->setData(file_get_contents($file->getPathName()))
            ->setMimeType($file->getMimeType())
        ;

        return $myimage;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    public function getMimeType()
    {
        return $this->mimeType;
    }
}
