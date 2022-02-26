<?php

namespace App\Exports;

use App\Models\Template;
use App\Models\Consignment;
use App\Models\TemplateDetail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ExportToxlsx implements FromView
{
    private $planilla;
     
     
    public function __construct(Template $planilla) {
        $this->planilla = $planilla;
    }

    public function view(): View {

        $template = Template::find($this->planilla->id);

        // dd($template);

        #Consulto las consgnaciones
        $consignments = Consignment::where('template_id', $template->id)->get();
        #Asigno un array para las consignaciones y las agrego
        $consignmentsArray = [];
        #Asigno la variable  real cash
        $template->actualCash = "";
        foreach ($consignments as $consignment) {
            if ($consignment->real_cash == 0) {
                array_push($consignmentsArray, $consignment->value);
            } else {
                $template->actualCash = $consignment->real_cash;
            }
        }

        #asigno las variables  que se renderizan en el view
        $template->consignment = $consignmentsArray;
        $template->responsible_name = $template->user_store_name;
        $template->responsible_identification = $template->user_store_identification;
        $template->point_name = $template->store_name;
        $template->deliveri = $template->total_delivery;
   
        #Consulto los detalles de la plantilla
        $templateDetails =  TemplateDetail::where('template_id', $template->id)->get();

        $creditInvoice = [];
        $cardSales = [];
        $customOrders = [];
        $electronicSales = [];
        $expense = [];
        #Recorro los detalles  los asigno cada uno a su respectivo arreglo
        foreach ($templateDetails as $templateDetail) {
            switch ($templateDetail) {
                case $templateDetail->sale_type_id == 1:

                    $templateDetail->invoice_number =   $templateDetail->invoice;
                    array_push($creditInvoice, $templateDetail);
                    break;
                case $templateDetail->sale_type_id == 2:
                    $templateDetail->name =   $templateDetail->saleType->name;
                    $templateDetail->invoice_number =   $templateDetail->invoice;
                    array_push($cardSales, $templateDetail);
                    break;
                case $templateDetail->sale_type_id == 3:
                    $templateDetail->invoice_number =   $templateDetail->invoice;
                    $templateDetail->client =  $templateDetail->client_identification;
                    array_push($customOrders, $templateDetail);
                    break;
                case $templateDetail->sale_type_id == 4:
                    $templateDetail->client_identification =  $templateDetail->client_name;
                    array_push($electronicSales, $templateDetail);
                    break;
                case $templateDetail->sale_type_id == 5:
                    array_push($expense, $templateDetail);
                    break;
                default:
                    break;
            }
        }

        // dd($expense);

        $templateId = $template->id;

        return view('exportToxlx', compact("templateId", "template", "creditInvoice", "cardSales", "electronicSales", "customOrders", "expense"));
    }
}
