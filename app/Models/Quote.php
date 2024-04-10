<?php
declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property string $quote
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Quote extends Model
{
    use HasFactory;
    protected $fillable = [
        'quote',
    ];
}
