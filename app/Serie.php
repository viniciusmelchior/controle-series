<?php

namespace App;

use illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Serie extends Model {
    protected $table = 'series';
    public $timestamps = false;
    protected $fillable = ['nome'];

    public function temporadas(){
        return $this->hasMany(Temporada::class);
    }
}

?>