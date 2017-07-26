<?php
declare(strict_types=1);
namespace AppBundle\Controller;

use AppBundle\Entity\Place;
use AppBundle\Form\AdminPlaceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class AdminPlaceController extends Controller
{
    const BASE_VIEW = "AppBundle:AdminPlace:";

    /**
     * @Route("/", name="admin_places_create")
     */
    public function createAction(Request $request)
    {
        $place = new Place();

        $form = $this->createForm(AdminPlaceType::class, $place);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump("valid");
        }
        dump($place->getImage());
        return $this->render(
            self::BASE_VIEW.'create.html.twig',
            ['form' => $form->createView()]
        );
    }
}
