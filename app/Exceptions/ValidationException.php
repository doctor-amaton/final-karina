<?php

namespace App\Exceptions;

/**
 * Tipo de excepcion que sera lanzado en caso de que el usuario haga algo mal
 */
class ValidationException extends \Exception
{
    /**
     * Construir la excepcion, el codigo de error es HTTP 400 BAD REQUEST por default
     *
     * @param $message  Mensaje amigable para el usuario
     * @param $code     Codigo HTTP de error
     * @param $previous Excepcion anterior para vincular las excepciones
     */
    public function __construct($message, $code = 400, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
