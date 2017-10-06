<?php

namespace App\Models;

use App\Jobs\ProcessStat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Stat
 * @package App\Models
 * @property int     $id
 * @property string  $user_agent
 * @property string  $ip
 * @property string  $os
 * @property string  $country_code
 * @property integer $link_id
 * @property Carbon  $created_at
 * @property Link    $link
 */
class Stat extends Model
{
    const UPDATED_AT = null;

    protected $fillable = ['ip', 'link_id', 'user_agent'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function link()
    {
        return $this->belongsTo(Link::class);
    }

    public static function store(Request $request, int $linkId)
    {
        $ip        = $request->getClientIp();
        $userAgent = $request->header('User-Agent');

        $stat = new static([
            'ip'         => $ip,
            'link_id'    => $linkId,
            'user_agent' => $userAgent,
        ]);

        /** @var IpGeo $ipGeo */
        $ipGeo = IpGeo::where('ip', $ip)->first();
        if ($ipGeo) {
            $stat->country_code = $ipGeo->country_code;
        }

        $stat->save();
        ProcessStat::dispatch($stat);
    }
}