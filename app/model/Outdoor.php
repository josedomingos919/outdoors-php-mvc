<?php

namespace App\Model;

use App\Core\Model;

class Outdoor extends Model
{
    const STATUS_AVALIABLE          = 'Disponível';
    const STATUS_WAIT_PAYMENT       = 'A aguardar pagamento';
    const STATUS_WAITING_VALIDATION = 'Por Validar Pagamento';
    const STATUS_BUSY               = 'Ocupado';

    public $id;
    public $tipoId;
    public $price;
    public $status;
    public $communeId;

    public $province;
    public $commune;
    public $municipality;
    public $type;


    public function __construct($id, $tipoId, $price, $status, $communeId)
    {
        $this->id = $id;
        $this->tipoId = $tipoId;
        $this->price = $price;
        $this->status = $status;
        $this->communeId = $communeId;
    }
}
