<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FormObjectsMfe extends Component
{

    public $objects = [];
    public $order_number = "";
    public $client_identification = "";
    public $value = "";
    public $tmp = "";

    protected $listeners = ["addObjectToList" => "addObjectToList"];

    public function render()
    {
        return view('livewire.form-objects-mfe');
    }

    public function addObjectToList()
    {
        if (empty($this->order_number) || empty($this->client_identification) || empty($this->value) ) {
            return;
        }

        $object = [
            "order_number" => $this->order_number,
            "client_identification" => $this->client_identification,
            "value" => $this->value
        ];

        array_push($this->objects, $object);
        $this->order_number = "";
        $this->client_identification = "";
        $this->value = "";
    }

    public function removeObjectToList($order_number, $client_identification, $value)
    {
        $this->objects = $this->removeFromArray($this->objects, ["order_number" => $order_number, "client_identification" => $client_identification, "value" => $value]);
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