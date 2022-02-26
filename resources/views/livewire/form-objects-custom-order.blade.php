<div>
    <div class="bg-white rounded-lg shadow-md w-full p-3 inline-block mt-4"" >
        <h2>Describa encargos:</h2>

        <div class="grid grid-cols-6 gap-5">
            <div>
                <!-- <x-jet-label class="mb-2 mt-2" for="object-invoice" value="Factura" /> -->
                <x-jet-input class="block mt-1 w-full" type="text" placeholder="Factura" wire:model="invoice_number" value="{{ $invoice_number }}" />
                <x-jet-input-error for="object-invoice_number" class="mt-2" />
            </div>

            <div>
                <!-- <x-jet-label class="mb-2 mt-2" for="object-client" value="Cliente" /> -->
                <x-jet-input class="block mt-1 w-full"  type="text"  placeholder="Cliente" wire:model="client" value="{{ $client }}" />
                <x-jet-input-error for="object-client" class="mt-2" />
            </div>

            <div>
                <!-- <x-jet-label class="mb-2 mt-2" for="cash" value="Valor" /> -->
                <x-jet-input class="block mt-1 w-full" type="number"  placeholder="Anticipo" wire:model="advance" value="{{ $advance }}" />
                <x-jet-input-error for="advance" class="mt-2" />
            </div>

            <div>
                <!-- <x-jet-label class="mb-2 mt-2" for="cash" value="Valor" /> -->
                <x-jet-input class="block mt-1 w-full" type="number"  placeholder="Costo anterior" wire:model="previous_cost" value="{{ $previous_cost }}" />
                <x-jet-input-error for="previous_cost" class="mt-2" />
            </div>

            
            <div>
                <!-- <x-jet-label class="mb-2 mt-2" for="cash" value="Valor" /> -->
                <x-jet-input class="block mt-1 w-full" type="number" placeholder="Cancelación" wire:model="cancelation" value="{{ $cancelation }}" />
                <x-jet-input-error for="cancelation" class="mt-2" />
            </div>

            <span style="height:40px; width:60px;" class="bg-gray-900 rounded-lg py-2 px-4 text-white cursor-pointer" wire:click="addObjectToList">
                <svg fill="#ffffff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24px" height="24px">
                    <path d="M 12 2 C 6.4889971 2 2 6.4889971 2 12 C 2 17.511003 6.4889971 22 12 22 C 17.511003 22 22 17.511003 22 12 C 22 6.4889971 17.511003 2 12 2 z M 12 4 C 16.430123 4 20 7.5698774 20 12 C 20 16.430123 16.430123 20 12 20 C 7.5698774 20 4 16.430123 4 12 C 4 7.5698774 7.5698774 4 12 4 z M 11 7 L 11 11 L 7 11 L 7 13 L 11 13 L 11 17 L 13 17 L 13 13 L 17 13 L 17 11 L 13 11 L 13 7 L 11 7 z" />
                </svg>
            </span>
        </div>
 
        <div class="w-full">
            @error('object-invoice')
            <span class="text-red-600 p-3">
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>
    <div class="max-h-60 overflow-y-auto my-2">
        @foreach ($objects as $object)
        <div class="grid grid-cols-6 gap-5 ">
            <div>
                <!-- <label for="" class="w-full">Factura</label> -->
                <input type="text" name="object_custom_invoice[]" value="{{ $object['invoice_number'] }}" class="block mt-1 w-full" readonly>
            </div>

            <div>
                <!-- <label for="" class="w-full">cliente</label> -->
                <input type="text" name="object_custom_client[]" value="{{ $object['client'] }}" class="block mt-1 w-full" readonly>
            </div>

            <div>
                <!-- <label for="" class="w-full">Valor</label> -->
                <input type="text" name="object_custom_advance[]" value="{{ $object['advance'] }}" class="block mt-1 w-full" readonly>
            </div>

            <div>
                <!-- <label for="" class="w-full">Valor</label> -->
                <input type="text" name="object_custom_previus_cost[]" value="{{ $object['previous_cost'] }}" class="block mt-1 w-full" readonly>
            </div>

            <div>
                <!-- <label for="" class="w-full">Valor</label> -->
                <input type="text" name="object_custom_cancelation[]" value="{{ $object['cancelation'] }}" class="block mt-1 w-full" readonly>
            </div>

            <span style="height:40px; width:60px;" class="bg-red-600 text-white py-1 px-4 rounded-lg cursor-pointer" wire:click="removeObjectToList('{{ $object['invoice_number'] }}','{{ $object['client'] }}','{{ $object['advance'] }}','{{ $object['previous_cost'] }}','{{ $object['cancelation'] }}')">
                <svg fill="#ffffff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24px" height="24px" class="align-middle w-full h-full">
                    <path d="M 10 2 L 9 3 L 4 3 L 4 5 L 5 5 L 5 20 C 5 20.522222 5.1913289 21.05461 5.5683594 21.431641 C 5.9453899 21.808671 6.4777778 22 7 22 L 17 22 C 17.522222 22 18.05461 21.808671 18.431641 21.431641 C 18.808671 21.05461 19 20.522222 19 20 L 19 5 L 20 5 L 20 3 L 15 3 L 14 2 L 10 2 z M 7 5 L 17 5 L 17 20 L 7 20 L 7 5 z M 9 7 L 9 18 L 11 18 L 11 7 L 9 7 z M 13 7 L 13 18 L 15 18 L 15 7 L 13 7 z" />
                </svg>
            </span>
        </div>
        @endforeach
    </div>
</div>