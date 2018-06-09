<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 10/02/2018
 * Time: 19:46
 */

namespace AppBundle\CCP;


use Symfony\Component\Config\Definition\Exception\Exception;
use Throwable;

class EsiException extends Exception
{

    private $detail;

    /**
     * EsiException constructor.
     * @param string $detail
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    function __construct(string $detail, string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->detail = $detail;
    }


    /**
     * @return string
     */
    public function getDetail(){
        return $this->detail;
    }

}