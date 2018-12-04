<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Fixture;
use AppBundle\Repository\FixtureRepository;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class RestFixtureController extends Controller
{
    /**
     * @View()
     * @Get("/rest/fixtures/referee/{id_referee}", name="_rest_fixture_by_referee_id")
     * @throws \Doctrine\Common\Annotations\AnnotationException
     */
    public function getFixturesByRefereeAction($id_referee, EntityManagerInterface $em)
    {
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));

        $normalizer = new ObjectNormalizer($classMetadataFactory);
        $normalizer->setCircularReferenceLimit(2);
        // Add Circular reference handler
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = array($normalizer);
        $encoders = array(new JsonEncoder());
        $serializer = new Serializer($normalizers, $encoders);

        $fixture_repository = $em->getRepository(Fixture::class);
        $fixture = $fixture_repository->findOneByReferee($id_referee);

        $fixture = $serializer->serialize($fixture, 'json', ['groups' => ['referee']]);
        $response = new Response(
            $fixture,
            Response::HTTP_OK,
            ['Content-type' => 'application/json']
        );

        return $response;
    }

    /**
     * @View()
     * @Post("/rest/fixtures/{id}/start-match", name="_rest_fixture_start_match")
     */
    public function postFixturesStartMatchAction(Fixture $fixture, EntityManagerInterface $em)
    {
        $fixture = $fixture->setStartDate(new \DateTime());
        $em->persist($fixture);
        $em->flush();

        return new Response('', Response::HTTP_OK);
    }
}