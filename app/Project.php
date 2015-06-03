<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(){
        return $this->belongsToMany('App\User', 'project_user', 'project_id', 'user_id');
	}

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function commentprojects(){
        return $this->hasMany('App\Commentproject');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks(){
        return $this->hasMany('App\Task');
    }

    /**
     * @param $project
     * @return array
     */
    public static function getUserIdToProject($project){
        $userIDs = [];
        foreach($project->users as $user)
            $userIDs [] = $user->id;
        return $userIDs;
    }
}
