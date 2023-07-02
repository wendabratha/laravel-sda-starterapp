<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;

class Kabupaten extends Model
{
    use LogsActivity;
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'kabupatens';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'kabupaten_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['kabupaten_id', 'kabupaten'];

    /**
     * Change activity log event description
     *
     * @param string $eventName
     *
     * @return string
     */
    public function getDescriptionForEvent($eventName)
    {
        return __CLASS__ . " model has been {$eventName}";
    }

    public function getActivitylogOptions()
    {
        return LogOptions::defaults();
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }
    
    public function kecamatan()
    {
        return $this->hasMany(Kecamatan::class);
    }

    public function kelurahan()
    {
        return $this->hasMany(Kelurahan::class);
    }
    
}