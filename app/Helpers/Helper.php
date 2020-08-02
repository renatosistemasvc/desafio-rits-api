<?php
namespace App\Helpers;
use Config;

class Helper
{

    public static function getStatusPedido($cod){

		switch($cod) {
            case 1:
                return "Pendente";
            break;
            case 2:
                return "Em preparo";
            break;
            case 3:
                return "Em entrega";
            break;
            case 4:
                return "Entregue";
            break;
            case 5:
                return "Cancelado";
            default:
                return "Não identificado";
        }
    }

}
