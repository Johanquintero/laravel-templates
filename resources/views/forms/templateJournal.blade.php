<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                    <div class="md:grid md:grid-cols md:gap">
                        <div class="md:col-span-1">
                            <x-jet-section-title>
                                <x-slot name="title">
                                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Planilla de cuadres</h2>
                                </x-slot>
                                <x-slot name="description">
                                </x-slot>

                            </x-jet-section-title>
                        </div>
                        <div class="mt-5 md:mt-2 md:col-span-2">

                            <form method="POST" enctype="multipart/form-data" action="{{ route($formAction,[$templateId !== null ?  $templateId : '' ]) }}">
                                @csrf

                                <div>
                                    Reponsable
                                </div>

                                <div class="grid grid-cols-3 gap-5">
                                    <x-jet-input id="template_type" type="number" max="191" name="template_type" value="{{ $id }}" hidden />
                                    <x-jet-input id="date" type="text" max="191" name="date" value="{{ $bodyJson['date'] ?? ''  }}" hidden />
                                    <x-jet-input id="initial_invoice" type="text" max="191" name="initial_invoice" value="{{ $bodyJson['initial_invoice'] ?? '' }}" hidden />
                                    <x-jet-input id="final_invoice" type="text" max="191" name="final_invoice" value="{{ $bodyJson['final_invoice'] ?? '' }}" hidden />

                                    <div>
                                        <x-jet-label class="mb-2 mt-2" for="name" value="{{ __('Name') }}" />
                                        <x-jet-input id="name" class="block mt-1 w-full" type="text" max="191" name="name" value="{{ $bodyJson['responsible_name']  ?? old('name') }}" required />
                                        <x-jet-input-error for="name" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-jet-label class="mb-2 mt-2" for="identification" value="Identificación" />
                                        <x-jet-input id="identification" class="block mt-1 w-full" type="number" minLength="8" maxlength="20" name="identification" value="{{ $bodyJson['responsible_identification']  ?? old('identification') }}" required />
                                        <x-jet-input-error for="identification" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-jet-label class="mb-2 mt-2" for="ptsale" value="Punto de venta" />
                                        <x-jet-input id="ptsale" class="block mt-1 mb-4 w-full" type="text" max="191" name="ptsale" value="{{ $bodyJson['point_name'] ?? old('ptsale') }}" required />
                                        <x-jet-input-error for="ptsale" class="mt-2" />
                                    </div>
                                </div>

                                <hr>

                                <livewire:form-objects :objects="$creditInvoice" />

                                <hr>

                                <livewire:form-objects-target :objects="$cardSales" />

                                <hr>

                                <livewire:form-objects-custom-order :objects="$customOrders" />

                                <hr>

                                <livewire:form-objects-mfe :objects="$electronicSales" />

                                <hr>

                                <livewire:form-objects-expense :objects="$expense" />

                                <hr>


                                <div class="mt-1/6">
                                    <x-jet-label class="mb-2 mt-2" for="deliveri" value="Recaudo domicilios" />
                                    <x-jet-input id="deliveri" class="block mt-1 w-full" type="number" maxlength="191" name="deliveri" value="{{ $bodyJson['deliveri'] ?? old('deliveri') }}" required />
                                    <x-jet-input-error for="deliveri" class="mt-2" />
                                </div>

                                <div class="grid grid-cols-3 gap-5">
                                    <div>
                                        <x-jet-label class="mb-2 mt-2" for="Consignment1" value="Consignación 1" />
                                        <x-jet-input id="Consignment" class="block mt-1 w-full" type="text" max="191" name="consignment[]" value="{{ $bodyJson->consignment[0] ?? old('consignment[0]') }}" required />
                                        <x-jet-input-error for="consignment1" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-jet-label class="mb-2 mt-2" for="consignment2" value="Consignación 2" />
                                        <x-jet-input id="consignment" class="block mt-1 w-full" type="number" maxlength="20" name="consignment[]" value="{{$bodyJson->consignment[1]  ?? old('consignment[1]') }}" required />
                                        <x-jet-input-error for="Consignment" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-jet-label class="mb-2 mt-2" for="actualCash" value="Efectivo Real" />
                                        <x-jet-input id="actualCash" class="block mt-1 mb-4 w-full" type="text" max="191" name="actualCash" value="{{ $bodyJson->actualCash ?? old('actualCash') }}" required />
                                        <x-jet-input-error for="actualCash" class="mt-2" />
                                    </div>
                                </div>

                                <div class="grid grid-cols-5 gap-2">

                                    @if($formAction == 'update-template')
                                    <div>
                                        <x-jet-label class="mb-2 mt-2" for="file" value="Archivo" />
                                        <x-jet-input placeholder="Choose file" id="file" type="file" multiple class="block mt-1 w-full" name="file[]" />
                                        <x-jet-input-error for="file" class="mt-2" />
                                    </div>
                                    @else
                                    <div>
                                        <x-jet-label class="mb-2 mt-2" for="file" value="Archivo" />
                                        <x-jet-input required placeholder="Choose file" id="file" type="file" multiple class="block mt-1 w-full" name="file[]" />
                                        <x-jet-input-error for="file" class="mt-2" />
                                    </div>
                                    @endif

                                    <div class="mb-2">
                                        <img id="preview-image" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif" alt="preview image" width="150px" height="150px">
                                    </div>

                                </div>

                                <!-- <div class="grid grid-cols-5 gap-2">
                                    @if(isset($bodyJson->files))
                                        @foreach($bodyJson->files as $file)                                       
                                            <div class="mb-2">
                                                <img id="preview-image"  src="{{url($file->name)}}" alt="preview image" width="150px" height="150px">
                                            </div>
                                        @endforeach
                                    @endif
                                </div> -->

                                <div class="mt-1/6">
                                    <x-jet-label class="mb-2 mt-2" for="observations" value="Observaciones" />
                                    <textarea id="observations" class="form-textarea border-1 w-full" rows="5" name="observations" value="{{ $bodyJson->observation ?? old('observations') }}">{{ $bodyJson->observation ?? old('observations') }}</textarea>
                                    <x-jet-input-error for="observations" class="mt-2" />
                                </div>



                                <div class="flex items-center justify-end mt-4">
                                    <x-jet-button class="ml-4">
                                        {{ $formAction == 'update-template' ? __('Update') :  __('Create') }}
                                    </x-jet-button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script type="text/javascript">
        $('#file').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);

        });
    </script>


</x-app-layout>