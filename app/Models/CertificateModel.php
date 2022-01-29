<?php

namespace App\Models;

use CodeIgniter\Model;


class CertificateModel extends Model
{
  protected $table = 'tbl_certificate';
  protected $primaryKey = 'id_cert';
  protected $allowedFields = ['name', 'training_name', 'training_date', 'organizer', 'from_date', 'to_date', 'name_cert'];
}

 ?>