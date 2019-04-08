<?php

namespace Tests\Unit\app\Http\Requests;

use Tests\Unit\app\Http\Requests\BaseRequest\Inheritor;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BaseRequestTest extends TestCase
{
    use DatabaseTransactions;

    public function testAuthorize()
    {
        $request = new Inheritor;
        $this->assertTrue($request->authorize());
    }

    public function testValidate()
    {
        $request = new Inheritor;
        $this->assertEquals([], $request->validate([]));
    }
}
