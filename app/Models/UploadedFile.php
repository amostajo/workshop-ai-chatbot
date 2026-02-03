<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Uploaded file reference model (context file).
 * 
 * @author Ale Mostajo <https://github.com/amostajo>
 * @version 1.0.0
 */
class UploadedFile extends Model
{
    /**
     * Fillable attributes.
     * @since 1.0.0
     * 
     * @var array
     */
    protected $fillable = [
        'provider',
        'provider_id',
        'key',
        'filename',
        'file_in_storage',
    ];
}
