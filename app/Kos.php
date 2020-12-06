<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Kos extends Model
{
    protected $fillable = [
        'namakos', 'alamatkos', 'hargakos', 'nohpkos', 'imageID', 'latitude', 'longitude'
    ];
        
    public function getCreatedAtAttribute(){
        if(!is_null($this->attributes['created_at'])){
            return Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i:s');
        }
    }
        
            public function getUpdatedAtAttribute(){
                if(!is_null($this->attributes['updated_at'])){
                    return Carbon::parse($this->attributes['updated_at'])->format('Y-m-d H:i:s');
                }
            }
}
