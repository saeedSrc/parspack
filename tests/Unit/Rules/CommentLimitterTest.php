<?php

namespace Tests\Unit\Rules;

use App\Models\User;
use App\Rules\CommentLimitter;
use Symfony\Component\VarDumper\Cloner\Stub;
use Tests\TestCase;

class CommentLimitterTest extends TestCase
{
    /**
     * @group unit
     * @dataProvider productNameDataProvider
     */
    public function testPassesShouldWork(string|array|int|object $productName, bool $expected): void
    {
        //arrange
        $rule = new CommentLimitter();

        $user = User::find(81);
        $this->be($user);

        //act
        $actual = $rule->passes('nothing', $productName);

        $this->assertEquals($expected, $actual);
    }

    public function productNameDataProvider(): array
    {
        return [
            'should work' => [
                'product',
                true
            ],
            'should work again' => [
                'product',
                true
            ],
            'should not work' => [// because we already have 2 "product3"
                'product3',
                false
            ],
        ];
    }
}
