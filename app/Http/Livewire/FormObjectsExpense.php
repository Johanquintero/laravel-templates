<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FormObjectsExpense extends Component
{

    public $objects = [];
    public $expenseInvoice = "";
    public $expenseName = "";
    public $expenseValue = "";
    public $tmp = "";

    protected $listeners = ["addObjectToList" => "addObjectToList"];

    public function render()
    {
        return view('livewire.form-objects-expense');
    }

    public function addObjectToList()
    {
        if (empty($this->expenseInvoice) || empty($this->expenseName) || empty($this->expenseValue) ) {
            return;
        }

        $object = [
            "expenseInvoice" => $this->expenseInvoice,
            "expenseName" => $this->expenseName,
            "expenseValue" => $this->expenseValue
        ];

        array_push($this->objects, $object);
        $this->expenseInvoice = "";
        $this->expenseName = "";
        $this->expenseValue = "";
    }

    public function removeObjectToList($expenseInvoice, $expenseName, $expenseValue)
    {
        $this->objects = $this->removeFromArray($this->objects, ["expenseInvoice" => $expenseInvoice, "expenseName" => $expenseName, "expenseValue" => $expenseValue]);
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