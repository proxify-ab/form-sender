<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Files
 *
 * @package App\Models
 * @mixin \Eloquent
 * @property int $id
 * @property int $size
 * @property string $name
 * @property string $mime
 * @property string $extension
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Files whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Files whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Files whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Files whereMime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Files whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Files whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Files whereUpdatedAt($value)
 */
class Files extends Model
{
    /** @var array */
    protected $fillable = ['name', 'mime', 'extension', 'size'];
}
