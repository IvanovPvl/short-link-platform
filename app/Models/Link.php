<?php

declare(strict_types=1);

namespace App\Models;

use PDOException;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

use App\Services\ShortCreator;

/**
 * Class Link
 * @package App\Models
 * @property int    $id
 * @property string $original
 * @property string $short
 * @property int    $user_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property User   $user
 * @property Stat[] $stats
 */
class Link extends Model
{
    protected $fillable = ['original', 'short', 'user_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stats()
    {
        return $this->hasMany(Stat::class);
    }

    /**
     * @param string $original
     * @param int    $userId
     *
     * @return mixed
     */
    public static function store(string $original, int $userId): Link
    {
        /** @var ShortCreator $creator */
        $creator = app()->make(ShortCreator::class);

        try {
            return static::create([
                'short'    => $creator->generate(),
                'user_id'  => $userId,
                'original' => $original,
            ]);
        } catch (PDOException $ex) {
            return static::store($original, $userId);
        }
    }
}