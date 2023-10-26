<?php

namespace App\Repositories\Merchandise;

use App\Models\Merchandise;
use App\Repositories\BaseRepository;

class MerchandiseRepository extends BaseRepository implements MerchandiseRepositoryInterface{
    public function getModel()
    {
        return Merchandise::class;
    }
}