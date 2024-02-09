<?php

namespace App\Models;

use CodeIgniter\Model;

class MessagesModel extends Model
{
    protected $table = 'messages';

    public function getMessage()
    {
        $messagecount = $this->countAll();
        $messageid = rand(1, $messagecount);

        return $this->find($messageid);
    }
}