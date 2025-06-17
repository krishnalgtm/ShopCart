<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    use HasFactory;

    
    protected $table = "role"; // Make sure this matches your actual roles table name
    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(User::class, 'role_id'); // Assuming 'role_id' is the foreign key in users table
    }

    public static function getRecord()
    {
        return self::withCount('users')->get(); // users रिलेशन का उपयोग करते हुए गिनती प्राप्त करें
    }
    

    public static function getSingle($id)
    {
        return self::find($id);
    }
}
