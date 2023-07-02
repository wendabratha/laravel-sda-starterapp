<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;

class Kelurahan extends Model
{
    use LogsActivity;
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'kelurahans';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'kelurahan_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['kelurahan_id', 'kelurahan'];

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

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function potensisda()
    {
        return $this->hasMany(Potensisda::class);
    }
}
