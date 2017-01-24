<?php

namespace DOLucasDelivery\Presenters;

use DOLucasDelivery\Transformers\OrderTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class OrderPresenter
 *
 * @package namespace DOLucasDelivery\Presenters;
 */
class OrderPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new OrderTransformer();
    }
}
