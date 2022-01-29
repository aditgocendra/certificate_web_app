<?php

namespace App\Models;

use CodeIgniter\Model;


class ProfileModel extends Model
{
  protected $table = 'users';
  protected $primaryKey = 'id_users';
  protected $allowedFields = ['username', 'password', 'image_profile', 'gender', 'whatsapp', 'email', 'address'];
}

 ?>