<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\PackageDetailModel;

class PackageModel extends Model
{
    protected $table = 'packages';
    protected $fillable = ['name', 'package_id', 'tracking_number', 'date_received'];

    public function packageDetails() {
        return $this->hasMany(PackageDetailModel::class, 'package_id', 'package_id');
    }
}
