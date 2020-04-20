<?php

namespace App\Models;

use DateTime;
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

    public function getSexFormattedAttribute() {
        if (NULL == $this->sex) {
            return null;
        }
        return $this->sex == 'm' ? 'Masculino' : 'Feminino';
    }

    public function getMaritalStatusFormattedAttribute() {
        if (NULL == $this->marital_status) {
            return null;
        }        
        return self::MARITAL_STATUS[$this->marital_status];
    }

    public function getDateBirthFormattedAttribute() {
        if (NULL == $this->date_birth) {
            return null;
        }        
        $date = new DateTime($this->date_birth);
        return $date->format('d/m/Y');
    }

    public function getDocumentNumberFormattedAttribute() {
        if (NULL == $this->document_number) {
            return null;
        }
        if (strlen($this->document_number) == 11) {
            return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $this->document_number);
        } if (strlen($this->document_number) == 14) {
            return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $this->document_number);
        } if (strlen($this->document_number) == 15) {
            return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $this->document_number);
        } else {
            return $this->document_number;
        }
    }

    public function setDocumentNumberAttribute($value) {
        $this->attributes['document_number'] = preg_replace('/[^0-9]/', '', $value);
    }
}