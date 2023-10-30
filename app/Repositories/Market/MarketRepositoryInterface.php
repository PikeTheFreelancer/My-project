<?php

namespace App\Repositories\Market;

interface MarketRepositoryInterface {
    public function getAllMerchandises();
    public function getAllComments($merchandiseId);
    public function getSomeComments($merchandiseId, $amount);
}