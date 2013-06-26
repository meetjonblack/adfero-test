<?php

namespace AdferoTest\MapBundle\Controller;

use AdferoTest\MapBundle\Entity\Location;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

class MapController extends Controller
{
    public function indexAction()
    {
        $locations = $this->getDoctrine()
            ->getRepository('AdferoTestMapBundle:Location')
            ->findAll();

        return $this->render( 'AdferoTestMapBundle:Map:index.html.twig', array('locations' => $locations));
    }

    public function createAction()
    {
        $location = new Location();

        $form = $this->createFormBuilder($location)
            ->add('name', 'text')
            ->add('xCoordinate', 'text')
            ->add('yCoordinate', 'text')
            ->add('description', 'text')
            ->add('save', 'submit')
            ->getForm();


        $form->handleRequest($this->getRequest());

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($location);
            $em->flush();

            return $this->redirect($this->generateUrl('adfero_test_map_homepage'));
        }

        return $this->render('AdferoTestMapBundle:New:index.html.twig', array('form' =>$form->createView()));
    }

    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $location = $em->getRepository('AdferoTestMapBundle:Location')->find($id);

        if (!$location) {
            throw $this->createNotFoundException(
                'No location found for id '.$id
            );
        }

        $em->flush();
        return $this->redirect($this->generateUrl('homepage'));
    }
    
    public function removeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $location = $em->getRepository('AdferoTestMapBundle:Location')->find($id);

        if (!$location) {
            throw $this->createNotFoundException(
                'No location found for id '.$id
            );
        }

        $em->flush();

        return $this->redirect($this->generateUrl('homepage'));
    }

    public function showAction()
    {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());

        $serializer = new Serializer($normalizers, $encoders);

        $location = $this->getDoctrine()
            ->getRepository('AdferoTestMapBundle:Location')
            ->findAll();

        $jsonContent = $serializer->serialize($location, 'json');

        return new Response($jsonContent);
    }
}
