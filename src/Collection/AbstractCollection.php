<?php

namespace App\Collection;

use App\Entity\Item;
use App\Transformer\GramTransformer;
use App\Transformer\KilogramTransformer;
use App\Transformer\TransformerAdapter;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class AbstractCollection implements CollectionInterface
{
    protected EntityManagerInterface $entityManager;
    protected EntityRepository $repository;
    protected ValidatorInterface $validator;

    public function __construct(EntityManagerInterface $entityManager, ValidatorInterface $validator)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository($this->getEntityClass());
        $this->validator = $validator;
    }

    public function store(Item $item): void
    {
        $errors = $this->validator->validate($item);

        if (count($errors) > 0) {
            $messages = [];
            foreach ($errors as $violation) {
                $messages[$violation->getPropertyPath()][] = $violation->getMessage();
            }

            throw new \InvalidArgumentException(json_encode($messages));
        }

        $this->entityManager->persist($item);
        $this->entityManager->flush();
    }

    public function remove(Item $item): void
    {
        $this->entityManager->remove($item);
        $this->entityManager->flush();
    }

    public function list(string $unit = 'gram'): array
    {
        $items = $this->repository->findAll();

        return match ($unit) {
            'kilogram' => TransformerAdapter::getTransformer(KilogramTransformer::class)->transform($items),
            'gram' => TransformerAdapter::getTransformer(GramTransformer::class)->transform($items),
            default => $items,
        };
    }

    public function search(array $filters, string $unit = 'gram'): array
    {
        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('i')
            ->from($this->repository->getClassName(), 'i');

        if (!empty($filters['name'])) {
            $qb->andWhere('i.name LIKE :name')
                ->setParameter('name', '%' . $filters['name'] . '%');
        }

        $items =  $qb->getQuery()->getResult();

        return match ($unit) {
            'kilogram' => TransformerAdapter::getTransformer(KilogramTransformer::class)->transform($items),
            'gram' => TransformerAdapter::getTransformer(GramTransformer::class)->transform($items),
            default => $items,
        };
    }

    public abstract function getEntityClass(): string;
    public abstract function add(array $data): Item;
}
