<?php

namespace App\Controller;

use App\Collection\CollectionAdapter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/items', name: 'items_')]
class ItemController extends AbstractController
{
    private CollectionAdapter $itemCollectionAdapter;

    public function __construct(CollectionAdapter $itemCollectionAdapter)
    {
        $this->itemCollectionAdapter = $itemCollectionAdapter;
    }

    #[Route('/add', name: 'add', methods: ['POST'])]
    public function add(Request $request): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);
            $type = $data['type'] ?? 'fruit';

            return new JsonResponse($this->itemCollectionAdapter->getCollection($type)->add($data));
        } catch (\Exception $exception) {
            return new JsonResponse(['message' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/list', name: 'list', methods: ['GET'])]
    public function list(Request $request): JsonResponse
    {
        try {
            $type = $request->query->get('type', 'fruit');
            $unit = $request->query->get('unit', 'gram');

            return new JsonResponse($this->itemCollectionAdapter->getCollection($type)->list($unit));
        } catch (\Exception $exception) {
            return new JsonResponse(['message' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/search', name: 'search', methods: ['GET'])]
    public function search(Request $request): JsonResponse
    {
        try {
            $type = $request->query->get('type', 'fruit');
            $unit = $request->query->get('unit', 'gram');
            $filters = [
                'name' => $request->query->get('name'),
            ];

            return new JsonResponse($this->itemCollectionAdapter->getCollection($type)->search($filters, $unit));
        } catch (\Exception $exception) {
            return new JsonResponse(['message' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
