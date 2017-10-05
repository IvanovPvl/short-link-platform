<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Stat
 * @package App\Models
 * @property int $id
 * @property string $user_agent
 * @property string $ip
 * @property string $os
 * @property string $countryCode
 * @property integer $link_id
 * @property Carbon $created_at
 * @property Link $link
 */
class Stat extends Model
{
    public $timestamps = false;

    public function setCreatedAtAttribute(): void
    {
        $this->timestamps['created_at'] = Carbon::now();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function link()
    {
        return $this->belongsTo(Link::class);
    }
}