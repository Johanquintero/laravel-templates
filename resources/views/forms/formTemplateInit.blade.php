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
                    <div class="md:grid md:grid-cols-3 md:gap-4">
                        <div class="md:col-span-1">
                            <x-jet-section-title>
                                <x-slot name="title">Descripción</x-slot>
                                <x-slot name="description">Planilla diaria de ventas</x-slot>
                            </x-jet-section-title>
                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            
                            <form method="POST" action="#">
                                @csrf

                                <div>
                                    <x-jet-label class="mb-4" for="name" value="{{ __('Name') }}" />
                                    <x-jet-input id="name" class="block mt-1 w-full" type="text" max="191" name="name" value="{{ old('name') }}" required />
                                    <x-jet-input-error for="name" class="mt-2" />
                                </div>

                                <div class="mt-1/6">
                                    <x-jet-label class="mb-4" for="code" value="{{ __('Code') }}" />
                                    <x-jet-input id="code" class="block mt-1 w-full" type="number" maxlength="191" name="code" value="{{ old('code') }}" required />
                                    <x-jet-input-error for="code" class="mt-2" />
                                </div>

                                <div class="mt-1/6">
                                    <x-jet-label class="mb-4" for="academic_level" value="{{ __('Academic level') }}" />
                                    <select id="academic_level" name="academic_level" class="form-select w-full" value="{{ old('academic_level') }}" required>
                                        <option value="">Seleccione el nivel académico</option>
                                        <option {{ old('academic_level') == "Técnico profesional" ? "selected" : "" }} value="Técnico profesional">Técnico profesional</option>
                                        <option {{ old('academic_level') == "Tecnólogo" ? "selected" : "" }} value="Tecnólogo">Tecnólogo</option>
                                        <option {{ old('academic_level') == "Profesional" ? "selected" : "" }} value="Profesional">Profesional</option>
                                        <option {{ old('academic_level') == "Especialización técnica profesional" ? "selected" : "" }} value="Especialización técnica profesional">Especialización técnica profesional</option>
                                        <option {{ old('academic_level') == "Especialización tecnológica" ? "selected" : "" }} value="Especialización tecnológica">Especialización tecnológica</option>
                                        <option {{ old('academic_level') == "Maestría" ? "selected" : "" }} value="Maestría">Maestría</option>
                                        <option {{ old('academic_level') == "Doctorado" ? "selected" : "" }} value="Doctorado">Doctorado</option>
                                    </select>
                                    <x-jet-input-error for="academic_level" class="mt-2" />
                                </div>

                                <div class="mt-1/6">
                                    <x-jet-label class="mb-4" for="start_date" value="{{ __('Start date') }}" />
                                    <x-jet-input id="start_date" class="block mt-1 w-full" type="date" min="1900" max="{{ date('Y') + 10 }}" name="start_date" value="{{ old('start_date') }}" required />
                                    <x-jet-input-error for="start_date" class="mt-2" />
                                </div>

                                <div class="mt-1/6">
                                    <x-jet-label class="mb-4" for="end_date" value="{{ __('End date') }}" />
                                    <x-jet-input id="end_date" class="block mt-1 w-full" type="date" min="1900" max="{{ date('Y') + 10 }}" name="end_date" value="{{ old('end_date') }}" required />
                                    <x-jet-input-error for="end_date" class="mt-2" />
                                </div>

                                <div class="mt-1/6">
                                    <x-jet-label class="mb-4" for="modality" value="{{ __('Modality') }}" />
                                    <select id="modality" name="modality" class="form-select w-full" value="{{ old('modality') }}" required>
                                        <option value="">Seleccione la modalidad</option>
                                        <option {{ old('modality') == "Presencial" ? "selected" : "" }} value="Presencial">Presencial</option>
                                        <option {{ old('modality') == "A distancia" ? "selected" : "" }} value="A distancia">A distancia</option>
                                    </select>
                                    <x-jet-input-error for="modality" class="mt-2" />
                                </div>

                                <div class="mt-1/6">
                                    <x-jet-label class="mb-4" for="daytime" value="{{ __('Daytime') }}" />
                                    <select id="daytime" name="daytime" class="form-select w-full" value="{{ old('daytime') }}" required>
                                        <option value="">Seleccione la jornada</option>
                                        <option {{ old('daytime') == "Mixta" ? "selected" : "" }} value="Mixta">Mixta</option>
                                        <option {{ old('daytime') == "Nocturna" ? "selected" : "" }} value="Nocturna">Nocturna</option>
                                    </select>
                                    <x-jet-input-error for="daytime" class="mt-2" />
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