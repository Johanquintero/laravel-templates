<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FormObjectsTarget extends Component
{

    public $objects = [];
    public $name = "";
    public $invoice_number = "";
    public $value = "";
    public $tmp = "";

    protected $listeners = ["addObjectToList" => "addObjectToList"];

    public function render()
    {
        return view('livewire.form-objects-target');
    }

    public function addObjectToList()
    {
        if (empty($this->name) || empty($this->invoice_number) || empty($this->value) ) {
            return;
        }

        $object = [
            "name" => $this->name,
            "invoice_number" => $this->invoice_number,
            "value" => $this->value
        ];

        array_push($this->objects, $object);
        $this->name = "";
        $this->invoice_number = "";
        $this->value = "";
    }

    public function removeObjectToList($name, $invoice_number, $value)
    {
        $this->objects = $this->removeFromArray($this->objects, ["name" => $name, "invoice_number" => $invoice_number, "value" => $value]);
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