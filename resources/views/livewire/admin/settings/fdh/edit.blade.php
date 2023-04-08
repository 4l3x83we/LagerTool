<div class="px-4 py-3 bg-gray-50 rounded shadow-md dark:bg-gray-800">
    <div class="grid grid-cols-1 gap-4 mb-4 lg:grid-cols-2">
        <input type="hidden" wire:model="selected_id">
        <div>
            <x-ag.label for="fhd_hersteller" text="Hersteller" stern="true" />
            <x-ag.select id="fhd_hersteller" name="fhd_hersteller" wire:model.lazy="fzHersteller">
                @foreach($herstellers as $hersteller)
                    <option value="{{ $hersteller->id }}">{{ $hersteller->hr_name }}</option>
                @endforeach
            </x-ag.select>
        </div>
        <div>
            @if(!is_null($fzHersteller))
                <x-ag.label for="model_id" text="Model" stern="true" />
                <x-ag.select id="model_id" name="model_id" wire:model.lazy="model_id">
                    @foreach($models as $model)
                        <option value="{{ $model->id }}">{{ $model->md_name }}</option>
                    @endforeach
                </x-ag.select>
            @endif
        </div>
    </div>
    <div class="grid grid-cols-1 gap-4 mb-4 lg:grid-cols-3">
        <div>
            <x-ag.label for="fdh_hsn" text="HSN" stern="true" />
            <x-ag.input type="text" id="fdh_hsn" wire:model="fdh_hsn" placeholder="HSN" />
        </div>
        <div>
            <x-ag.label for="fdh_tsn" text="TSN" stern="true" />
            <x-ag.input type="text" id="fdh_tsn" wire:model="fdh_tsn" placeholder="TSN" />
        </div>
        <div>
            <x-ag.label for="fdh_type" text="Type" stern="true" />
            <x-ag.input type="text" id="fdh_type" wire:model="fdh_type" placeholder="Type" />
        </div>
        <div>
            <x-ag.label for="fdh_kw" text="kW" stern="true" />
            <x-ag.input type="text" id="fdh_kw" wire:model="fdh_kw" placeholder="kW" />
        </div>
        <div>
            <x-ag.label for="fdh_hubraum" text="Hubraum" stern="true" />
            <x-ag.input type="text" id="fdh_hubraum" wire:model="fdh_hubraum" placeholder="Hubraum" />
        </div>
        <div>
            <x-ag.label for="fdh_kraftstoff" text="Kraftstoffart" stern="true" />
            <x-ag.select id="model_id" name="fdh_kraftstoff" wire:model.lazy="fdh_kraftstoff">
                @foreach($arrays['kraftstoff'] as $kraftstoff)
                    <option value="{{ $kraftstoff }}">{{ $kraftstoff }}</option>
                @endforeach
            </x-ag.select>
        </div>
    </div>
    <div class="grid grid-cols-1 gap-4 mb-4">
        <div class="flex justify-end items-center">
            <x-ag.buttonLink wire:loading.remove wire:click="update()" icon-left="fa-save" text="Speichern"/>
        </div>
        <div wire:loading wire:target="update" class="flex justify-center items-center">
            <div class="text-center">
                <div role="status">
                    <svg aria-hidden="true" class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                    </svg>
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
    </div>
</div>
