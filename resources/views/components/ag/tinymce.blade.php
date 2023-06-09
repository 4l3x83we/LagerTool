<style>
    html .tox-tinymce {
        border: 1px solid #D1D5DB !important;
        border-radius: 0.25rem !important;
    }
    html .tox .tox-edit-area__iframe {
        border: #D1D5DB !important;
    }
    html.dark .tox-tinymce {
        border: 1px solid #4B5563 !important;
        border-radius: 0.25rem !important;
    }
    html.dark .tox .tox-edit-area__iframe {
        border: #4B5563 !important;
    }
</style>
<script src="https://cdn.tiny.cloud/1/53e1tip0oepb1d25vvj08xkbumpxwhae75ghq6btf0pl905w/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea',
        skin: "oxide-dark",
        // content_css: '/css/app.css',
        height: '250',
        menubar: true,
        plugins: [
            'lists',
            'advlist',
            'link',
            'autolink',
            'image',
            'charmap',
            'preview',
            'anchor',
            'autosave',
            'searchreplace',
            'visualblocks',
            'fullscreen',
            'insertdatetime',
            'media',
            'table',
            'emoticons',
            'wordcount',
            'autoresize'
        ],
        toolbar: 'undo redo | ' +
            'alignleft aligncenter alignright alignjustify alignnone | ' +
            'indent outdent lineheight | ' +
            'fontfamily fontsize bold italic underline strikethrough subscript superscript | ' +
            'image media charmap searchreplace link | ' +
            'numlist bullist anchor | ' +
            'insertdatetime | ' +
            'table tabledelete | ' +
            'preview fullscreen copy paste cut visualblocks | ' +
            'emoticons | ' +
            'wordcount restoredraft print',
        toolbar_mode: 'floating',
        link_default_target: '_blank',
        link_assume_external_targets: true,
        insertdatetime_formats: [ '%H:%M:%S', '%d.%m.%Y', '%d.%m.%Y %H:%M' ],
        autoresize_overflow_padding: 5,
        autoresize_bottom_margin: 25,
        language: 'de',
    });
    // Prevent Bootstrap dialog from blocking focusin
    /*document.addEventListener('focusin', (e) => {
        if (e.target.closest(".tox-tinymce, .tox-tinymce-aux, .moxman-window, .tam-assetmanager-root") !== null) {
            e.stopImmediatePropagation();
        }
    });*/
</script>
