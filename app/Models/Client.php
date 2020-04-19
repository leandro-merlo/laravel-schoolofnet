<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    const TYPE_INDIVIDUAL = 'Individual';
    const TYPE_LEGAL = 'Legal';

    const MARITAL_STATUS = [
        1 => 'Solteiro',
        2 => 'Casado',
        3 => 'Divorciado',
    ];

    protected $fillable = [
        'name',
        'document_number',
        'email',
        'phone',
        'date_birth',
        'sex',
        'defaulter',
        'marital_status',
        'physical_disability',
        'client_type',
        'company_name'
    ];

    public static function getClientType($type){
        return $type == Client::TYPE_LEGAL ? Client::TYPE_LEGAL : Client::TYPE_INDIVIDUAL;
    }
}