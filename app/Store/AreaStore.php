<?php
namespace App\Store;

use Carbon\Carbon;
use App\Utils\Common;
use Log;

class AreaStore extends BaseStore
{
    protected $connection = 'mongodb';
    protected $table = 'binli_area';
}