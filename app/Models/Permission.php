<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'short_description'
    ];

    public function groupByMenu()
    {
        $result = [];
        foreach ($this->all()->toArray() as $permission) {
            $result[$permission['menu']][$permission['id']] = $permission['short_description'];
        }
        return $result;
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_permissions', 'permission_id', 'user_id');
    }
}
