<?php
declare(strict_types=1);

namespace AppBundle\Entity;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

class Place
{
    /**
     * Used for form.
     *
     * @Assert\Image(
     *     mimeTypes = {"image/png", "image/jpeg"},
     *     minWidth = 50,
     *     maxWidth = 1000,
     *     minHeight = 50,
     *     maxHeight = 1000,
     *     maxSize = "2K"
     * )
     */
    private $imageFile = null;

    protected $image;

    /**
     * Name of the organization
     *
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Length(max=10)
     */
    private $name;

    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setImage(MyImage $image = null)
    {
        $this->image = $image;

        return $this;
    }
    public function getImage()
    {
        return $this->image;
    }

    public function setImageFile(File $file)
    {
        $this->imageFile = $file;
        return $this;
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }
}
