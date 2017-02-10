<?php

namespace DOLucasDelivery\Presenters;

use DOLucasDelivery\Transformers\ClientTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ClientPresenter
 *
 * @package namespace DOLucasDelivery\Presenters;
 */
class ClientPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ClientTransformer();
    }
}
