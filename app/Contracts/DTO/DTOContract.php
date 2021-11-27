<?php


namespace App\Contracts\DTO;


interface DTOContract
{
    public static function arrayOf(array $arrayOfParameters): array;

    public function all(): array;

    public function only(string ...$keys): static;

    public function except(string ...$keys): static;

    public function clone(...$args): static;

    public function toArray(): array;
}
