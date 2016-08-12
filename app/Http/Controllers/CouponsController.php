<?php

namespace DOLucasDelivery\Http\Controllers;

use Illuminate\Http\Request;

use DOLucasDelivery\Http\Requests;
use DOLucasDelivery\Http\Requests\AdminCouponRequest;
use DOLucasDelivery\Http\Controllers\Controller;
use DOLucasDelivery\Repositories\CouponRepository;

class CouponsController extends Controller
{
    
    /**
     * @var CouponRepository
     */
    private $repository;

    public function __construct(CouponRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $coupons = $this->repository->paginate(15);

        return view('admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupons.create');
    }

    public function store(AdminCouponRequest $request)
    {
        $data = $request->all();
        $this->repository->create($data);

        return redirect()->route('admin.coupons.index');
    }

    public function edit($id)
    {
        $category = $this->repository->find($id);

        return view('admin.coupons.edit', compact('category'));
    }

    /*
    public function update(AdminCouponRequest $request, $id)
    {
        $data = $request->all();
        $this->repository->update($data, $id);

        return redirect()->route('admin.coupons.index');
    }
    */
}
