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
                                        <x-jet-label class="mb-2 mt-2" for="identification" value="Identificación" />
                                        <x-jet-input id="identification" class="block mt-1 w-full" type="number" minLength="8" maxlength="20" name="identification" value="{{ old('identification') }}" required />
                                        <x-jet-input-error for="identification" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-jet-label class="mb-2 mt-2" for="ptsale" value="Punto de venta" />
                                        <x-jet-input id="ptsale" class="block mt-1 mb-4 w-full" type="text" max="191" name="ptsale" value="{{ old('ptsale') }}" required />
                                        <x-jet-input-error for="ptsale" class="mt-2" />
                                    </div>
                                </div>

                                <hr>

                                <livewire:form-objects />

                                <hr>

                                <livewire:form-objects-target />

                                <hr>

                                <livewire:form-objects-custom-order />

                                <hr>

                                <livewire:form-objects-mfe />

                                <hr>

                                <livewire:form-objects-expense />

                                <hr>


                                <div class="mt-1/6">
                                    <x-jet-label class="mb-2 mt-2" for="deliveri" value="Recaudo domicilios" />
                                    <x-jet-input id="deliveri" class="block mt-1 w-full" type="number" maxlength="191" name="deliveri" value="{{ old('deliveri') }}" required />
                                    <x-jet-input-error for="deliveri" class="mt-2" />
                                </div>

                                <div class="grid grid-cols-3 gap-5">
                                    <div>
                                        <x-jet-label class="mb-2 mt-2" for="Consignment1" value="Consignación 1" />
                                        <x-jet-input id="Consignment1" class="block mt-1 w-full" type="text" max="191" name="Consignment1" value="{{ old('Consignment1') }}" required />
                                        <x-jet-input-error for="Consignment1" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-jet-label class="mb-2 mt-2" for="Consignment2" value="Consignación 2" />
                                        <x-jet-input id="Consignment2" class="block mt-1 w-full" type="number" min="8" max="20" name="Consignment2" value="{{ old('Consignment2') }}" required />
                                        <x-jet-input-error for="Consignment2" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-jet-label class="mb-2 mt-2" for="actualCash" value="Efectivo Real" />
                                        <x-jet-input id="actualCash" class="block mt-1 mb-4 w-full" type="text" max="191" name="actualCash" value="{{ old('actualCash') }}" required />
                                        <x-jet-input-error for="actualCash" class="mt-2" />
                                    </div>
                                </div>

                                <div class="mt-1/6">
                                    <x-jet-label class="mb-2 mt-2" for="observations" value="Observaciones" />
                                    <textarea id="observations" class="form-textarea border-1 w-full" rows="5" name="observations" value="{{ old('observations') }}">{{ old('observations') }}</textarea>
                                    <x-jet-input-error for="observations" class="mt-2" />
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