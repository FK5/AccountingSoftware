<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Permission;

class role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    public const MANAGER = 1;
    public const COMPANY_WEBMASTER = 2;
    public const COMPANY_OFFICER = 3;

    /**
     * The roles that belong to the permission
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
