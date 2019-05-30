<?php

namespace app\common\transformer;

class StepsTransformer extends Transformer
{
   public function transform($item,$info = false)
   {
      if (empty($item)) {
        return [];
      }

      return $item;
   }
}

