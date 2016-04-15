<?php
/**
 * Created by PhpStorm.
 * User: beck
 * Date: 4/12/2016
 * Time: 12:58 AM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScrubberScrubber extends Model {
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'scrubbers';

    public function scopeOfScrubber($query, $value)
    {
        return $query->where('description', $value);
    }


} 