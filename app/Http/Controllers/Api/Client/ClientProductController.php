<?php

namespace DOLucasDelivery\Http\Controllers\Api\Client;

use DOLucasDelivery\Http\Controllers\Controller;
use DOLucasDelivery\Repositories\ProductRepository;

class ClientProductController extends Controller
{
    
    /**
     * @var ProductRepository
     */
    private $productRepository;

    
    public function __construct(ProductRepository $productRepository) 
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products = $this->productRepository->skipPresenter(false)->all();
        return $products;
    }
}
