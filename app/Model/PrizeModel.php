<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PrizeModel extends Model
{
    protected $table = 'p_prize';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $guarded = [];   //黑名单  create只需要开启
}
