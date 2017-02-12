<?php

namespace DOLucasDelivery\Transformers;

use DOLucasDelivery\Models\OrderItem;
use League\Fractal\TransformerAbstract;

/**
 * Class OrderItemTransformer
 * @package namespace DOLucasDelivery\Transformers;
 */
class OrderItemTransformer extends TransformerAbstract
{
    
    protected $defaultIncludes = ['product'];

    /**
     * Transform the \OrderItem entity
     * @param \OrderItem $model
     *
     * @return array
     */
    public function transform(OrderItem $model)
    {
        return [
            'id'         => (int) $model->id,
            'product_id' => (int) $model->product_id,
            'qty'        => (int) $model->qty,
            'price'      => (float) $model->price,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
    
    public function includeProduct(OrderItem $model)
    {
        return $this->item($model->product, new ProductTransformer());
    }
}
