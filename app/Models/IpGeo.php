<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class IpGeo
 * @package App\Models
 * @property int $id
 * @property string $ip
 * @property string $country
 * @property string $country_code
 * @property string $region
 * @property string $region_name
 * @property string $city
 */
class IpGeo extends Model
{
    protected $table = 'ip_geo';
}