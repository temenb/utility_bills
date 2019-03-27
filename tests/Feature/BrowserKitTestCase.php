<?php

namespace Tests\Feature;

use Tests\CreatesApplication;
use Laravel\BrowserKitTesting\TestCase as BaseTestCase;

abstract class BrowserKitTestCase extends BaseTestCase
{
    use CreatesApplication;

    public function __get($key) {
        if ('baseUrl' == $key) {
            return env('APP_URL', 'http://localhost');
        }
    }
}
