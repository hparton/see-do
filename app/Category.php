<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use App\City;

class Category extends Model implements SluggableInterface
{
    use SluggableTrait;

    protected $sluggable = [
        'build_from' => 'title',
        'save_to'    => 'slug',
        'unique'     => false,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'user_id',
        'city_id',
        'color_scheme_id',
        'icon',
    ];

    public function events()
    {
        return $this->hasMany('App\Event');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function colorScheme()
    {
        return $this->belongsTo('App\ColorScheme');
    }

    public function icon()
    {
        return $this->belongsTo('App\Icon');
    }

    public function futureEvents(City $city)
    {
        return $this->events()->where('city_id', $city->id)->where('time_end', '>=', date('Y-m-d H:i:s'));
    }

    public function futureEventsCount(City $city)
    {
        return $this->events()->where('city_id', $city->id)->where('time_end', '>=', date('Y-m-d H:i:s'))->count();
    }

}
