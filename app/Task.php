<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model {

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
  /*  public function comments() {
        return $this->hasMany('App\Comment');
    }*/

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project() {
        return $this->belongsTo('App\Project');
    }
}
