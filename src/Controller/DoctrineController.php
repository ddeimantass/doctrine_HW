<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DoctrineController extends Controller
{
    /**
     * @Route("/add", name="add")
     */
    public function add()
    {
        $category = new Category();
        $category->setTitle("Gėrimai");

        $product = new Product();
        $product->setTitle("Vanduo")
            ->setPrice("1")
            ->setCategoty($category)
            ->setActive(1);

        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush($product);

        return new Response('Product added');
    }

    /**
     * @Route("/remove/{id}", name="remove")
     */
    public function remove($id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->find(Product::class, $id);
        $em->remove($product);
        $em->flush($product);

        return new Response('Product removed');
    }
}
