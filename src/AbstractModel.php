<?php
declare(strict_types=1);

namespace app\src;

use app\src\Request;

abstract class AbstractModel 
{
    public function getDataFromRequest(array $data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }
}