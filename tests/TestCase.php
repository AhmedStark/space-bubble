<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

abstract class TestCase extends BaseTestCase 
{
    use CreatesApplication, AuthenticableTrait;
}
