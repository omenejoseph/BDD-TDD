<?php
namespace App\Actions\Contracts;

interface ActionAbleContract
{
    public function handle(array $data, ?\Closure $closure = null);
}
