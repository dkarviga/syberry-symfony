<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/28/2018
 * Time: 1:26 PM
 */

namespace AppBundle\Controller\Front;

use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use AppBundle\Repository\ProductRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProductController
 * @package AppBundle\Controller\Front
 * @Route("/products")
 */
class ProductController extends Controller
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @param ProductRepository $productRepository
     * @required
     */
    public function setProductRepository(ProductRepository $productRepository): void
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @Route("/{productId}", name="product-view", methods={"GET"})
     * @param $productId
     * @return Response
     */
    public function viewAction($productId): Response
    {
        $product = $this->productRepository->findOneById($productId);

        return $this->render('static/aboutus.html.twig');

    }

    /**
     * @Route("/{productId}", name="update-product", methods={"PUT"})
     * @param $productId
     * @param Request $request
     * @return Response
     */
    public function updateAction($productId, Request $request): Response
    {
        /**
         * @var Product $product
         */
        $product = $this->findOneByIdOrThrowException($productId);

        $this->setProductData($request, $product);

        $this->productRepository->save($product);

        return $this->json([]);
    }

    /**
     * @Route("/{productId}", name="update-product", methods={"DELETE"})
     * @param $productId
     * @param Request $request
     * @return Response
     */
    public function deleteAction($productId): Response
    {
        /**
         * @var Product $product
         */
        $product = $this->findOneByIdOrThrowException($productId);

        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();

        return $this->json([]);
    }

    /**
     * @Route("", name="create-product", methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request): Response
    {
        $category = new Category();
        $category->setName('Gadgets');

        $entityManager = $this->getEntityManager();

        $product = new Product();
        $product->setCategory($category);


        $this->setProductData($request, $product);

        $entityManager->persist($product);

        $entityManager->flush();

        return $this->json([]);
    }

    /**
     * @Route("", name="list-action", methods={"GET"})
     * @param Request $request
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function listAction(Request $request)
    {
        $name = $request->get('name');
        $minPrice = $request->get('minPrice');

        if ($name && $minPrice) {
            /*$products = $this->getEntityManager()->createQuery(
                'SELECT p
                FROM AppBundle:Product p
                WHERE p.name = :name
                  AND p.price >= :price'
            )
                ->setParameter('name', $name)
                ->setParameter('price', $minPrice)
                ->getOneOrNullResult();*/

            $qb = $this
                ->getEntityManager()
                ->createQueryBuilder();

            $products = $qb
                ->select('p')
                ->from('AppBundle:Product', 'p')
                ->where($qb->expr()->andX(
                    $qb->expr()->eq('p.name', ':name'),
                    $qb->expr()->gte('p.price', ':price')
                ))
                ->setParameter('name', $name)
                ->setParameter('price', $minPrice)
                ->getQuery()
                ->getDQL();

            var_dump($products);
            exit();
        } else {
            throw new BadRequestHttpException();
        }
    }

    /**
     * @param Request $request
     * @param $product
     */
    private function setProductData(Request $request, Product $product): void
    {
        $data = json_decode($request->getContent(), true);
        $product
            ->setName($data['name'])
            ->setPrice($data['price'])
            ->setDescription($data['description'])
            ->setCountryName($data['countryName']);
    }

    /**
     * @param $productId
     * @return Product|null|object
     */
    private function findOneByIdOrThrowException($productId)
    {
        $product = $this
            ->productRepository
            ->findOneById($productId);

        if ($product != null) {
            return $product;
        } else {
            throw $this->createNotFoundException();
        }
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager|EntityManagerInterface
     */
    private function getEntityManager()
    {
        $entityManager = $this->getDoctrine()->getManager();
        return $entityManager;
    }
}