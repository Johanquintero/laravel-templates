<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FormObjects extends Component
{

    public $objects = [];
    public $invoice_number = "";
    public $client_identification = "";
    public $value = "";
    public $tmp = "";

    protected $listeners = ["addObjectToList" => "addObjectToList"];

    public function render()
    {
        return view('livewire.form-objects');
    }

    public function addObjectToList()
    {
        if (empty($this->invoice_number) || empty($this->client_identification) || empty($this->value) ) {
            return;
        }

        $object = [
            "invoice_number" => $this->invoice_number,
            "client_identification" => $this->client_identification,
            "value" => $this->value
        ];

        array_push($this->objects, $object);
        $this->invoice_number = "";
        $this->client_identification = "";
        $this->value = "";
    }

    public function removeObjectToList($invoice_number, $client_identification, $value)
    {
        $this->objects = $this->removeFromArray($this->objects, ["invoice_number" => $invoice_number, "client_identification" => $client_identification, "value" => $value]);
    }

    private function removeFromArray(array $array, array $array_to_remove)
    {
        $returned_array = [];

        foreach ($array as $internal_array) {
            if ($internal_array !== $array_to_remove) {
                array_push($returned_array, $internal_array);
            }
        }

        return $returned_array;
    }
}