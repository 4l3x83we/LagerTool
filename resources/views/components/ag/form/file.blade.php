<div class="mt-4"
     wire:ignore
     x-data
     x-init="FilePond.registerPlugin(FilePondPluginImagePreview, FilePondPluginFileValidateType, FilePondPluginFileValidateSize);
         FilePond.setOptions({
             allowMultiple: {{ isset($attributes['multiple']) ? 'true' : 'false' }},
             server: {
                 process:(fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                     @this.upload('{{ $attributes->whereStartsWith('wire:model')->first() }}', file, load, error, progress)
                 },
                 revert: (filename, load) => {
                     @this.removeUpload('{{ $attributes->whereStartsWith('wire:model')->first() }}', filename, load)
                 },
             },
         });

         const pond = FilePond.create($refs.input, {
             imagePreviewHeight: 270,
             allowFileTypeValidation: 'true',
             acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'],
             allowFileSizeValidation: 'true',
             maxFileSize: '10mb'
         });

         this.addEventListener('pondReset', e => {
             pond.removeFile();
         });
     "
>
    <input type="file" x-ref="input" credits="false" />
    <x-ag.form.error id="{{ $id }}" />
</div>
@push('css')
    @once
        <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
        <style>
            .filepond--root {
                margin-bottom: 0.5em;
            }

            /* use a hand cursor intead of arrow for the action buttons */
            .filepond--file-action-button {
                cursor: pointer;
            }

            /* the text color of the drop label*/
            .dark .filepond--drop-label {
                color: #D1D5DB;
            }

            /* underline color for "Browse" button */
            .dark .filepond--label-action {
                text-decoration-color: #D1D5DB;
                color: #D1D5DB;
            }

            /* the background color of the filepond drop area */
            .dark .filepond--panel-root {
                background-color: #374151;
            }

            /* the border radius of the drop area */
            .filepond--panel-root {
                border-radius: 0.25rem;
            }

            /* the border radius of the file item */
            .filepond--item-panel {
                border-radius: 0.25rem;
            }

            /* the background color of the file and file panel (used when dropping an image) */
            .filepond--item-panel {
                background-color: #555;
            }

            /* the background color of the drop circle */
            .filepond--drip-blob {
                background-color: #999;
            }

            /* the background color of the black action buttons */
            .filepond--file-action-button {
                background-color: rgba(0, 0, 0, 0.5);
            }

            /* the icon color of the black action buttons */
            .filepond--file-action-button {
                color: white;
            }

            /* the color of the focus ring */
            .filepond--file-action-button:hover,
            .filepond--file-action-button:focus {
                box-shadow: 0 0 0 0.125em rgba(255, 255, 255, 0.9);
            }

            /* the text color of the file status and info labels */
            .filepond--file {
                color: white;
            }

            /* error state color */
            [data-filepond-item-state*='error'] .filepond--item-panel,
            [data-filepond-item-state*='invalid'] .filepond--item-panel {
                background-color: red;
            }

            [data-filepond-item-state='processing-complete'] .filepond--item-panel {
                background-color: green;
            }

            /* bordered drop area */
            .filepond--panel-root {
                background-color: transparent;
                border: 0 solid #2c3340;
            }
        </style>
    @endonce
@endpush

@push('js')
    @once
        <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
        <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    @endonce
@endpush

@push('scripts')

@endpush
