<?php

namespace App\Controller;

use App\Dto\TagInput;
use App\Entity\Bookmark;
use App\Entity\Tag;
use App\Manager\BookmarkManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/api/bookmarks/{uuid}/tags")
 */
class TagController
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
     * @Route("/{uuidTag}", name="getBookmarkTag", methods={"GET"})
     * @ParamConverter("bookmark", options={"mapping": {"uuid" : "id"}})
     * @ParamConverter("tag", options={"mapping": {"uuidTag" : "id"}})
     * @param Bookmark $bookmark
     * @param Tag $tag
     * @return JsonResponse
     */
    public function get(Bookmark $bookmark, Tag $tag): JsonResponse
    {
        return (new JsonResponse())
            ->setContent($this->serializer->serialize($tag, 'json'));
    }


    /**
     * @Route("/", name="getBookmarkTags", methods={"GET"})
     * @ParamConverter("bookmark", options={"mapping": {"uuid" : "id"}})
     * @param Bookmark $bookmark
     * @return JsonResponse
     */
    public function list(Bookmark $bookmark): JsonResponse
    {
        return (new JsonResponse())
            ->setContent($this->serializer->serialize($bookmark->getTags(), 'json'));
    }

    /**
     * @Route("/", name="addTagToBookmark", methods={"POST"}, format="json")
     * @ParamConverter("bookmark", options={"mapping": {"uuid" : "id"}})
     * @param Bookmark $bookmark
     * @param Request $request
     * @return JsonResponse
     */
    public function post(Bookmark $bookmark, Request $request): JsonResponse
    {

        /** @var TagInput $tagInput */
        $tagInput = $this->serializer->deserialize($request->getContent(), TagInput::class, "json");

        $constraintViolationList = $this->validator->validate($tagInput);

        $response = new JsonResponse();

        if ($constraintViolationList->count() === 0) {

            $tag = (new Tag())
                ->setLabel($tagInput->getLabel())
                ->setBookmark($bookmark);

            $bookmark->addTag($tag);
            $this->bookmarkManager->save($bookmark);
            $response->setStatusCode(Response::HTTP_CREATED);
        } else {
            $response
                ->setJson($this->serializer->serialize($constraintViolationList, 'json'))
                ->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        return $response;
    }

    /**
     * @Route("/{uuidTag}", name="deleteTag", methods={"DELETE"})
     * @ParamConverter("bookmark", options={"mapping": {"uuid" : "id"}})
     * @ParamConverter("tag", options={"mapping": {"uuidTag" : "id"}})
     * @param Bookmark $bookmark
     * @param Tag $tag
     * @return JsonResponse
     */
    public function delete(Bookmark $bookmark, Tag $tag): JsonResponse
    {
        $this->bookmarkManager->deleteTag($tag);

        return new JsonResponse();
    }
}
