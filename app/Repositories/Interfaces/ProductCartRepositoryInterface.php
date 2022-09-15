<?php

namespace App\Repositories\Interfaces;

interface ProductCartRepositoryInterface
{
    public function add_to_cart($type);
    public function remove_to_cart($id);
}