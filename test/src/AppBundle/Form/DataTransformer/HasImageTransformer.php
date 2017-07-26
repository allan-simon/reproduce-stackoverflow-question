<?php

namespace AppBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use AppBundle\Entity\MyImage;

class HasImageTransformer implements DataTransformerInterface
{
    public function transform($hasImage)
    {
        return $hasImage;
    }

    /**
     * reverse transforms.
     */
    public function reverseTransform($hasImage)
    {
        $imageFile = $hasImage->getImageFile();

        if (is_null($imageFile)) {
            return null;
        }
        $myImage = MyImage::createFromFile($imageFile);
        $hasImage->setImage($myImage);
    }
}
