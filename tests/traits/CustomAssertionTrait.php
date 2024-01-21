<?php

namespace Tests\traits;

trait CustomAssertionTrait
{
    public function assertArrayData(array $array)
    {
        foreach (['nick', 'email', 'age'] as $key) {
            $this->assertArrayHasKey($key, $array, "Array doesn't contains the key: $key");
        }

        $this->assertIsString($array['nick'], "Nick field must be string");
        $this->assertMatchesRegularExpression('/^.+\@\S+\.\S+$/', $array['email'], "Email must be a valid email");
        $this->assertIsInt($array['age'], "Age must be integer");
    }
}