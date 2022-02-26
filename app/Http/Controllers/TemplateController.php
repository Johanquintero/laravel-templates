<?php

namespace App\Http\Controllers;

use App\Models\Consignment;
use App\Models\Template;
use App\Models\TemplateDetail;
use App\Models\TemplateType;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Excel;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = Template::all();

        return view('forms.index', compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function show(Template $template, $id, $bodyJson = "")
    {
        $formAction = 'create-template';
        $templateId = null;
        $creditInvoice = [];
        $cardSales = [];
        $electronicSales = [];
        $customOrders = [];
        $expense = [];

        if ($bodyJson != "") {
            $bodyJson = json_decode($bodyJson, true);
            $creditInvoice = $bodyJson['credit_invoices'];
            $cardSales = $bodyJson['card_sales'];
            $electronicSales = $bodyJson['electronic_sales'];
            $customOrders = $bodyJson['custom_orders'];

            // dd($customOrders);
            // var_dump($electronicSales);
        }

        if ($id == 1) {
            return view('forms.templateDaily');
        } else {
            return view('forms.templateJournal', compact("formAction", "templateId", "id", "bodyJson", "creditInvoice", "cardSales", "electronicSales", "customOrders", "expense"));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function edit(Template $template)
    {

        $formAction = 'update-template';

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
        $template->files = json_decode($template->url_images);

        #Consulto los detalles de la plantilla
        $templateDetails =  TemplateDetail::where('template_id', $template->id)->get();

        $creditInvoice = [];
        $cardSales = [];
        $customOrders = [];
        $electronicSales = [];
        $expense = [];
        #Recorro los detalles  los asigno cada uno a su respectivo arreglo
        foreach ($templateDetails as $templateDetail) {
            $objectNew = [];
            switch ($templateDetail) {
                case $templateDetail->sale_type_id == 1:
                    $objectNew['invoice_number']= $templateDetail->invoice;
                    $objectNew['client_identification']= $templateDetail->client_identification;
                    $objectNew['value']= strval($templateDetail->value);
                    array_push($creditInvoice, $objectNew);
                    break;
                case $templateDetail->sale_type_id == 2:
                    $objectNew['name']= $templateDetail->saleType->name;
                    $objectNew['invoice_number']= $templateDetail->invoice;
                    $objectNew['value']= strval($templateDetail->value);
                    array_push($cardSales, $objectNew);
                    break;
                case $templateDetail->sale_type_id == 3:
                    $objectNew['invoice_number'] =  $templateDetail->invoice;
                    $objectNew['client']= $templateDetail->client_identification;
                    $objectNew['advance']= strval($templateDetail->advance);
                    $objectNew['previous_cost']= strval($templateDetail->previous_cost);
                    $objectNew['cancelation']= strval($templateDetail->cancelation);
                    array_push($customOrders, $objectNew);
                    break;
                case $templateDetail->sale_type_id == 4:
                    $objectNew['order_number']= $templateDetail->order_number;
                    $objectNew['client_identification'] =  $templateDetail->client_name;
                    $objectNew['value']= strval($templateDetail->value);
                    array_push($electronicSales, $objectNew);
                    break;
                case $templateDetail->sale_type_id == 5:
                    $objectNew['expenseInvoice'] =  $templateDetail->invoice;
                    $objectNew['expenseName']= $templateDetail->client_name;
                    $objectNew['expenseValue']= strval($templateDetail->value);
                    array_push($expense, $objectNew);
                    break;
                default:
                    break;
            }
        }

        $id = $template->template_type_id;
        $bodyJson = $template;

        $templateId = $template->id;

        if ($id == 1) {
            return view('forms.templateDaily');
        } else {
            return view('forms.templateJournal', compact("formAction", "id", "templateId", "bodyJson", "creditInvoice", "cardSales", "electronicSales", "customOrders", "expense"));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Template $template)
    {
        // DB::beginTransaction();
        // try {

        $files = $request->file('file');
        $url_images = [];
        if (isset($files)) {
            foreach ($files as $file) {
                $extFile = explode("/", $file->getMimeType());
                $dateDay = date_format(new DateTime(), "Y/m/d H:i:s");
                $dateString = substr(strval($dateDay), 0, 10);
                $nameFile = "" . rand(1, 15) . str_replace(" ", "", $request->ptsale) . "_" . str_replace("/", "-", $dateString) . "." . $extFile[1];
                $path = $file->storeAs('public/files', $nameFile);
                array_push($url_images, array("name" => $path));
            }
        }

        $template_type = TemplateType::find($request->template_type);

        #Validations
        if ($request->observations == null) {
            if ($template->observation == null) {
                $request->observations = "";
            } else {
                $request->observations = $template->observation;
            }
        }

        if ($request->initial_invoice == null) {
            if ($template->initial_invoice == null) {
                $request->initial_invoice = "";
            } else {
                $request->initial_invoice = $template->initial_invoice;
            }
        }

        if ($request->final_invoice == null) {
            if ($template->final_invoice == null) {
                $request->final_invoice = "";
            } else {
                $request->final_invoice = $template->final_invoice;
            }
        }


        if (count($url_images) <= 0) {
            if (isset($template->url_images)) {
                $url_images =  $template->url_images;
            } else {
                $url_images = [];
            }
        }

        $template = Template::where('id', $id)->update([
            'template_type_id' => $template_type->id,
            'user_store_name' => $request->name ??  $template->user_store_name,
            'user_store_identification' => $request->identification ?? $template->user_store_identification,
            'store_name' => $request->ptsale ?? $template->store_name,
            'store_city' => $template->store_city ?? "",
            'store_address' =>   $template->store_address ?? "",
            'store_operation_center' => $template->store_operation_center ?? "",
            'date' => $request->date ?? date_format(new DateTime(), "Y/m/d H:i:s"),
            'observation' => $request->observations,
            'initial_invoice' => $request->initial_invoice ??  $template->initial_invoice,
            'final_invoice' => $request->final_invoice ??  $template->final_invoice,
            'total_sales' =>  $template->total_sales ?? "",
            'total_iva' => $template->total_iva ?? "",
            'total_ipc' => $template->total_ipc ?? "",
            'total_bag_tax' => $template->total_bag_tax ?? "",
            'total_delivery' => $request->deliveri ??  $template->total_delivery,
            'url_images' => $url_images,
            'value' => $template->value  ?? "",
        ]);

        #ventas a credito
        if (isset($request->object_invoice_number)) {
            if (count($request->object_invoice_number) > 0) {

                TemplateDetail::where([["sale_type_id", "=", 1], ["template_id", "=", $id]])->delete();

                for ($i = 0; $i < count($request->object_invoice_number); $i++) {
                    TemplateDetail::create([
                        'sale_type_id' => 1,
                        'template_id' => $id,
                        'type_cards' => "",
                        'invoice' => $request->object_invoice_number[$i] ?? "",
                        'order_number' => "",
                        'advance' => "",
                        'previous_cost' => "",
                        'cancelation' => "",
                        'client_identification' => $request->object_client_identification[$i] ?? "",
                        'client_phone_number' => "",
                        'client_name' => "",
                        'client_address' => "",
                        'value' => $request->object_value[$i] ?? "",
                    ]);
                }
            }
        }

        #ventas con tarjeta
        if (isset($request->object_type_target)) {
            if (count($request->object_type_target) > 0) {

                TemplateDetail::where([["sale_type_id", "=", 2], ["template_id", "=", $id]])->delete();

                for ($i = 0; $i < count($request->object_type_target); $i++) {
                    TemplateDetail::create([
                        'sale_type_id' => 2,
                        'template_id' => $id,
                        'type_cards' => $request->object_type_target[$i] ?? "",
                        'invoice' => $request->object_number_invoice_target[$i] ?? "",
                        'order_number' => "",
                        'advance' => "",
                        'previous_cost' => "",
                        'cancelation' => "",
                        'client_identification' => "",
                        'client_phone_number' => "",
                        'client_name' => "",
                        'client_address' => "",
                        'value' => $request->object_number_invoice_target[$i] ?? "",
                    ]);
                }
            }
        }

        #encargos
        if (isset($request->object_custom_invoice)) {
            if (count($request->object_custom_invoice) > 0) {

                TemplateDetail::where([["sale_type_id", "=", 3], ["template_id", "=", $id]])->delete();

                for ($i = 0; $i < count($request->object_custom_invoice); $i++) {
                    TemplateDetail::create([
                        'sale_type_id' => 3,
                        'template_id' => $id,
                        'type_cards' => "",
                        'invoice' => $request->object_custom_invoice[$i] ?? "",
                        'order_number' => "",
                        'advance' => $request->object_custom_advance[$i] ?? 0,
                        'previous_cost' => $request->object_custom_previus_cost[$i] ?? 0,
                        'cancelation' => $request->object_custom_cancelation[$i] ?? 0,
                        'client_identification' => $request->object_custom_client[$i] ?? "",
                        'client_phone_number' => "",
                        'client_name' => "",
                        'client_address' => "",
                        'value' => "",
                    ]);
                }
            }
        }

        #mfe
        if (isset($request->mfe_order_target)) {
            if (count($request->mfe_order_target) > 0) {

                TemplateDetail::where([["sale_type_id", "=", 4], ["template_id", "=", $id]])->delete();

                for ($i = 0; $i < count($request->mfe_order_target); $i++) {
                    TemplateDetail::create([
                        'sale_type_id' => 4,
                        'template_id' => $id,
                        'type_cards' => "",
                        'invoice' => "",
                        'order_number' => $request->mfe_order_target[$i] ?? "",
                        'advance' => "",
                        'previous_cost' => "",
                        'cancelation' => "",
                        'client_identification' => "",
                        'client_phone_number' => "",
                        'client_name' => $request->mfe_name_target[$i] ?? "",
                        'client_address' => "",
                        'value' => $request->mfe_cash_target[$i] ?? "",
                    ]);
                }
            }
        }

        #gastos
        if (isset($request->object_type_expense)) {
            if (count($request->object_type_expense) > 0) {

                TemplateDetail::where([["sale_type_id", "=", 5], ["template_id", "=", $id]])->delete();

                for ($i = 0; $i < count($request->object_type_expense); $i++) {
                    TemplateDetail::create([
                        'sale_type_id' => 5,
                        'template_id' => $id,
                        'type_cards' => "",
                        'invoice' => $request->object_type_expense[$i] ?? "",
                        'order_number' => "",
                        'advance' => "",
                        'previous_cost' => "",
                        'cancelation' => "",
                        'client_identification' => "",
                        'client_phone_number' => "",
                        'client_name' => $request->object_number_invoice_expense[$i] ?? "",
                        'client_address' => "",
                        'value' => $request->object_cash_expense[$i] ?? "",
                    ]);
                }
            }
        }

        if ($request->consignment) {

            Consignment::where([["real_cash", "=", 0], ["template_id", "=", $id]])->delete();

            for ($i = 0; $i < count($request->consignment); $i++) {
                Consignment::create([
                    'template_id' => $id,
                    'value' => $request->consignment[$i] ?? "",
                ]);
            }
        }

        if (isset($request->actualCash)) {

            Consignment::where([["value", "=", 0], ["template_id", "=", $id]])->delete();

            Consignment::create([
                'template_id' => $id,
                'real_cash' => $request->actualCash ?? "",
            ]);
        }

        DB::commit();
        return redirect()->route('index-template');
        // } catch (Exception $e) {
        //     DB::rollBack();
        //     return redirect()->back();
        // }
    }

    public function CreateTemplate(Request $request)
    {
        DB::beginTransaction();
        try {

            $files = $request->file('file');
            $url_images = [];

            foreach ($files as $file) {
                $extFile = explode("/", $file->getMimeType());
                $dateDay = date_format(new DateTime(), "Y/m/d H:i:s");
                $dateString = substr(strval($dateDay), 0, 10);
                $nameFile = "" . rand(1, 15) . str_replace(" ", "", $request->ptsale) . "_" . str_replace("/", "-", $dateString) . "." . $extFile[1];
                $path = $file->storeAs('public/files', $nameFile);
                array_push($url_images, array("name" => $path));
            }

            $template_type = TemplateType::find($request->template_type);

            // dd($template_type->id);

            $template = new Template();
            $template->template_type_id = $template_type->id;
            $template->user_store_name = $request->name ?? "";
            $template->user_store_identification = $request->identification ?? "";
            $template->store_name = $request->ptsale ?? "";
            $template->store_city = "";
            $template->store_address = "";
            $template->store_operation_center = "";
            $template->date = $request->date ?? date_format(new DateTime(), "Y/m/d H:i:s");
            $template->observation = $request->observations ?? "";
            $template->initial_invoice = $request->initial_invoice ?? "";
            $template->final_invoice = $request->final_invoice ?? "";
            $template->total_sales = "";
            $template->total_iva = "";
            $template->total_ipc = "";
            $template->total_bag_tax = "";
            $template->total_delivery = $request->deliveri ?? "";
            $template->url_images = json_encode($url_images);
            $template->value = "";

            $template->TemplateType()->associate($template_type->id);

            $template->save();


            #ventas a credito
            if (isset($request->object_invoice_number)) {
                if (count($request->object_invoice_number) > 0) {
                    for ($i = 0; $i < count($request->object_invoice_number); $i++) {
                        TemplateDetail::create([
                            'sale_type_id' => 1,
                            'template_id' => $template->id,
                            'type_cards' => "",
                            'invoice' => $request->object_invoice_number[$i] ?? "",
                            'order_number' => "",
                            'advance' => "",
                            'previous_cost' => "",
                            'cancelation' => "",
                            'client_identification' => $request->object_client_identification[$i] ?? "",
                            'client_phone_number' => "",
                            'client_name' => "",
                            'client_address' => "",
                            'value' => $request->object_value[$i] ?? "",
                        ]);
                    }
                }
            }

            #ventas con tarjeta
            if (isset($request->object_type_target)) {
                if (count($request->object_type_target) > 0) {
                    for ($i = 0; $i < count($request->object_type_target); $i++) {
                        TemplateDetail::create([
                            'sale_type_id' => 2,
                            'template_id' => $template->id,
                            'type_cards' => $request->object_type_target[$i] ?? "",
                            'invoice' => $request->object_number_invoice_target[$i] ?? "",
                            'order_number' => "",
                            'advance' => "",
                            'previous_cost' => "",
                            'cancelation' => "",
                            'client_identification' => "",
                            'client_phone_number' => "",
                            'client_name' => "",
                            'client_address' => "",
                            'value' => $request->object_cash_target[$i] ?? "",
                        ]);
                    }
                }
            }

            #encargos
            if (isset($request->object_custom_invoice)) {
                if (count($request->object_custom_invoice) > 0) {
                    for ($i = 0; $i < count($request->object_custom_invoice); $i++) {
                        TemplateDetail::create([
                            'sale_type_id' => 3,
                            'template_id' => $template->id,
                            'type_cards' => "",
                            'invoice' => $request->object_custom_invoice[$i] ?? "",
                            'order_number' => "",
                            'advance' => $request->object_custom_advance[$i] ?? 0,
                            'previous_cost' => $request->object_custom_previus_cost[$i] ?? 0,
                            'cancelation' => $request->object_custom_cancelation[$i] ?? 0,
                            'client_identification' => $request->object_custom_client[$i] ?? "",
                            'client_phone_number' => "",
                            'client_name' => "",
                            'client_address' => "",
                            'value' => "",
                        ]);
                    }
                }
            }

            #mfe
            if (isset($request->mfe_order_target)) {
                if (count($request->mfe_order_target) > 0) {
                    for ($i = 0; $i < count($request->mfe_order_target); $i++) {
                        TemplateDetail::create([
                            'sale_type_id' => 4,
                            'template_id' => $template->id,
                            'type_cards' => "",
                            'invoice' => "",
                            'order_number' => $request->mfe_order_target[$i] ?? "",
                            'advance' => "",
                            'previous_cost' => "",
                            'cancelation' => "",
                            'client_identification' => "",
                            'client_phone_number' => "",
                            'client_name' => $request->mfe_name_target[$i] ?? "",
                            'client_address' => "",
                            'value' => $request->mfe_cash_target[$i] ?? "",
                        ]);
                    }
                }
            }

            #gastos
            if (isset($request->object_type_expense)) {
                if (count($request->object_type_expense) > 0) {
                    for ($i = 0; $i < count($request->object_type_expense); $i++) {
                        TemplateDetail::create([
                            'sale_type_id' => 5,
                            'template_id' => $template->id,
                            'type_cards' => "",
                            'invoice' => $request->object_type_expense[$i] ?? "",
                            'order_number' => "",
                            'advance' => "",
                            'previous_cost' => "",
                            'cancelation' => "",
                            'client_identification' => "",
                            'client_phone_number' => "",
                            'client_name' => $request->object_number_invoice_expense[$i] ?? "",
                            'client_address' => "",
                            'value' => $request->object_cash_expense[$i] ?? "",
                        ]);
                    }
                }
            }

            if ($request->consignment) {
                for ($i = 0; $i < count($request->consignment); $i++) {
                    Consignment::create([
                        'template_id' => $template->id,
                        'value' => $request->consignment[$i] ?? "",
                    ]);
                }
            }

            if (isset($request->actualCash)) {
                Consignment::create([
                    'template_id' => $template->id,
                    'real_cash' => $request->actualCash ?? "",
                ]);
            }

            DB::commit();
            return redirect()->route('index-template');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back();
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function destroy(Template $template)
    {
        //
    }


    public function export(Template $planilla) {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\ExportToxlsx($planilla), 'archivo.xlsx');
    }
}
