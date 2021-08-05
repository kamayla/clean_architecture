<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    // プライマリーキーのカラム名
    protected $primaryKey = 'id';

    // プライマリーキーの型
    protected $keyType = 'string';

    // プライマリーキーは自動連番か？
    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'user_id',
    ];
}
