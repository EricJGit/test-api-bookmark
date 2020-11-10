<?php

namespace App\Controller;

use App\Dto\LienInput;
use App\Entity\Bookmark;
use App\Manager\BookmarkManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/api/bookmarks")
 */
class BookmarkController
{
    /** @var SerializerInterface */
    private SerializerInterface $serializer;

    /** @var ValidatorInterface */
    private ValidatorInterface $validator;

    /** @var BookmarkManager */
    private BookmarkManager $bookmarkManager;

    /**
     * BookmarkController constructor.
     * @param SerializerInterface $serializer
     * @param ValidatorInterface $validator
     * @param BookmarkManager $bookmarkManager
     */
    public function __construct(SerializerInterface $serializer, ValidatorInterface $validator, BookmarkManager $bookmarkManager)
    {
        $this->serializer = $serializer;
        $this->validator = $validator;
        $this->bookmarkManager = $bookmarkManager;
    }

    /**
     * @Route("/", name="addBookmark", methods={"POST"}, format="json")
     * @param Request $request
     * @return JsonResponse
     */
    public function post(Request $request): JsonResponse
    {
        /** @var LienInput $lien */
        $lien = $this->serializer->deserialize($request->getContent(), LienInput::class, "json");

        $constraintViolationList = $this->validator->validate($lien);

        $response = new JsonResponse();

        if ($constraintViolationList->count() === 0) {
            $this->bookmarkManager->createFormUrl($lien->getUrl());
            $response->setStatusCode(Response::HTTP_CREATED);
        } else {
            $response
                ->setJson($this->serializer->serialize($constraintViolationList, 'json'))
                ->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        return $response;
    }

    /**
     * @Route("/{uuid}", name="getBookmark", methods={"GET"})
     * @ParamConverter("bookmark", options={"mapping": {"uuid" : "id"}})
     * @param Bookmark $bookmark
     * @return JsonResponse
     */
    public function get(Bookmark $bookmark): JsonResponse
    {
        return (new JsonResponse())
            ->setContent($this->serializer->serialize($bookmark, 'json'));
    }


    /**
     * @Route("/", name="listBookmark", methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        $limit = $request->query->get('limit', 10);
        $start = $request->query->get('start', 0);
        $pager = $this->bookmarkManager->list($start, $limit);

        return (new JsonResponse())
            ->setContent($this->serializer->serialize($pager->getCurrentPageResults(), 'json'));
    }

    /**
     * @Route("/{uuid}", name="deleteBookmark", methods={"DELETE"})
     * @ParamConverter("bookmark", options={"mapping": {"uuid" : "id"}})
     * @param Bookmark $bookmark
     * @return JsonResponse
     */
    public function delete(Bookmark $bookmark): JsonResponse
    {
        $this->bookmarkManager->delete($bookmark);

        return new JsonResponse();
    }
}
