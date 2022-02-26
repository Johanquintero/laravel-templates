<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FormObjectsCustomOrder extends Component
{

    public $objects = [];
    public $invoice_number = "";
    public $client = "";
    public $advance = "";
    public $previous_cost = "";
    public $cancelation= "";
    public $tmp = "";

    protected $listeners = ["addObjectToList" => "addObjectToList"];

    public function render()
    {
        return view('livewire.form-objects-custom-order');
    }

    public function addObjectToList()
    {
        if (empty($this->invoice_number) || empty($this->client)) {
            return;
        }

        $object = [
            "invoice_number" => $this->invoice_number,
            "client" => $this->client,
            "advance" => $this->advance,
            "previous_cost" => $this->previous_cost,
            "cancelation" => $this->cancelation
        ];

        array_push($this->objects, $object);
        $this->invoice_number = "";
        $this->client = "";
        $this->advance = "";
        $this->previous_cost = "";
        $this->cancelation = "";
    }

    public function removeObjectToList($invoice_number, $client, $advance,$previous_cost,$cancelation)
    {
        $this->objects = $this->removeFromArray($this->objects, ["invoice_number" => $invoice_number, "client" => $client, "advance" => $advance , "previous_cost" => $previous_cost, "cancelation" => $cancelation]);
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