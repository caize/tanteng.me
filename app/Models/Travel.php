<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    protected $table = 'travel';

    protected $fillable = [
        'destination_id',
        'title',
        'seo_title',
        'description',
        'img_cover',
        'begin_date',
        'end_date',
        'content',
        'score'
    ];

    public function destination()
    {
        $this->belongsTo('\App\Models\Destination', 'destination_id');
    }
}
