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
                                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Planilla diaria de ventas</h2>
                                </x-slot>
                                <x-slot name="description">
                                </x-slot>
                                
                            </x-jet-section-title>
                        </div>
                        <div class="mt-5 md:mt-2 md:col-span-2">

                            <form method="POST" action="{{ route('create-template') }}">
                                @csrf

                                <div>
                                    Reponsable
                                </div>

                                <div class="grid grid-cols-3 gap-5">
                                    <div>
                                        <x-jet-label class="mb-2 mt-2" for="name" value="{{ __('Name') }}" />
                                        <x-jet-input id="name" class="block mt-1 w-full" type="text" max="191" name="name" value="{{ old('name') }}" required />
                                        <x-jet-input-error for="name" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-jet-label class="mb-2 mt-2" for="initialBilling" value="Factura inicial" />
                                        <x-jet-input id="initialBilling" class="block mt-1 w-full" type="text" name="initialBilling" value="{{ old('initialBilling') }}" required />
                                        <x-jet-input-error for="initialBilling" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-jet-label class="mb-2 mt-2" for="finalBilling" value="Factura Final" />
                                        <x-jet-input id="finalBilling" class="block mt-1 mb-4 w-full" type="text"  name="finalBilling" value="{{ old('finalBilling') }}" required />
                                        <x-jet-input-error for="finalBilling" class="mt-2" />
                                    </div>
                                </div>

                                <div class="grid grid-cols-5 gap-5">
                                    <div>
                                        <x-jet-label class="mb-2 mt-2" for="sales" value="Ventas" />
                                        <x-jet-input id="sales" class="block mt-1 w-full" type="text" max="191" name="sale" value="{{ old('sale') }}" required />
                                        <x-jet-input-error for="sale" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-jet-label class="mb-2 mt-2" for="iva19" value="IVA 19%" />
                                        <x-jet-input id="iva19" class="block mt-1 w-full" type="text" name="iva19" value="{{ old('iva19') }}" required />
                                        <x-jet-input-error for="iva19" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-jet-label class="mb-2 mt-2" for="ipc" value="IMP Consumo" />
                                        <x-jet-input id="ipc" class="block mt-1 mb-4 w-full" type="text"  name="ipc" value="{{ old('ipc') }}" required />
                                        <x-jet-input-error for="ipc" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-jet-label class="mb-2 mt-2" for="taxBag" value="IMP Bolsa" />
                                        <x-jet-input id="taxBag" class="block mt-1 w-full" type="text" name="taxBag" value="{{ old('taxBag') }}" required />
                                        <x-jet-input-error for="taxBag" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-jet-label class="mb-2 mt-2" for="totalValue" value="Total" />
                                        <x-jet-input id="totalValue" class="block mt-1 mb-4 w-full" type="text"  name="totalValue" value="{{ old('totalValue') }}" required />
                                        <x-jet-input-error for="totalValue" class="mt-2" />
                                    </div>
                                </div>

                                

                               

                    

                                <div class="flex items-center justify-end mt-4">
                                    <x-jet-button class="ml-4">
                                        {{ __('Create') }}
                                    </x-jet-button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>