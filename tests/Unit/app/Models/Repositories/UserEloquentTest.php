<?php

namespace Tests\Unit\app\Models\Repositories;

use App\Models\Entities\User;
use Tests\TestCase;
use App\Models\Repositories\UserRepoEloquent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserEloquentTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * @throws \Exception
     */
    public function testExtractUserId()
    {
        $rand = rand(0, 1000);
        $this->assertEquals($rand, UserRepoEloquent::extractUserId($rand));
        $user = factory(User::class)->create();
        $this->assertNotEquals($user->id, UserRepoEloquent::extractUserId());
        $this->assertEquals($user->id, UserRepoEloquent::extractUserId($user));
        auth()->login($user);
        $this->assertEquals($user->id, UserRepoEloquent::extractUserId());

    }
}
