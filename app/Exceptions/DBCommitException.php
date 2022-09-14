<?php

declare(strict_types=1);

namespace App\Exceptions;

class DBCommitException extends \Exception
{
    protected $message = 'Problem with saving Data';
}
