<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\PackageModel;

class PackageDetailModel extends Model
{
    protected $table = 'package_detail';
    protected $fillable = ['package_id', 'name', 'price', 'qty', 'weight'];
}
