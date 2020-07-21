<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Geofence extends Model
{
    use SoftDeletes;
    protected $table = "geofences";

    protected $geometry = ['coordinates'];
    protected $geometryAsText = true;

    protected $fillable = [
            'name',
            'region',
            'city',
            'district',
            'description',
            'status',
            'coordinates'
    ];

   /* public function newQuery($excludeDeleted = true)
    {
        if (!empty($this->geometry) && $this->geometryAsText === true)
        {
            $raw = '';
            foreach ($this->geometry as $column)
            {
                $raw .= 'AsText(`' . $this->table . '`.`' . $column . '`) as `' . $column . '`, ';
            }
            $raw = substr($raw, 0, -2);

            return parent::newQuery($excludeDeleted)->addSelect('*', DB::raw($raw));
        }

        return parent::newQuery($excludeDeleted);
    }*/
    //Places::first()->coordinates

    public function regions()
    {
        return $this->hasOne('App\State','region','id');
    }
}
