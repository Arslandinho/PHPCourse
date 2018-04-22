<?php
/**
 * Created by PhpStorm.
 * User: Arslan
 * Date: 22.04.2018
 * Time: 20:03
 */

namespace Exceptions;


class IException extends \Exception
{
    public function __toString()
    {
        return __CLASS__ . parent::__toString();
    }

}