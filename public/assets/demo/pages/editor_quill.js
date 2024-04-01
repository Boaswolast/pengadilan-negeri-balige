/* ------------------------------------------------------------------------------
 *
 *  # Quill editor
 *
 *  Demo JS code for editor_quill.html page
 *
 * ---------------------------------------------------------------------------- */


// Setup module
// ------------------------------


const QuillEditor = function() {


    //
    // Setup module components
    //

    // Quill editor
    const _componentQuill = function() {
        if (typeof Quill == 'undefined') {
            console.warn('Warning - summernote.min.js is not loaded.');
            return;
        }

        // Basic examples
        // ------------------------------

        // Basic example
        const quillBasic = new Quill('.quill-basic', {
            bounds: '.content-inner',
            placeholder: 'Please add your text here...',
            theme: 'snow'
        });

        quillBasic.on('text-change', function(delta, oldDelta, source) {
            document.getElementById("petitum-input").value = quillBasic.root.innerHTML;
        });
    };

        // Full features example
        // const quillFull = new Quill('.quill-full', {
        //     modules: {
        //         toolbar: [
        //             [{ 'font': [] }],
        //             [{ 'size': ['small', false, 'large', 'huge'] }],
        //             [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
        //             ['bold', 'italic', 'underline', 'strike'],
        //             ['blockquote', 'code-block'],
        //             [{ 'header': 1 }, { 'header': 2 }],
        //             [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        //             [{ 'script': 'sub'}, { 'script': 'super' }],
        //             [{ 'indent': '-1'}, { 'indent': '+1' }],
        //             [{ 'direction': 'rtl' }],
        //             [{ 'color': [] }, { 'background': [] }],
        //             [{ 'align': [] }],
        //             [ 'formula', 'image', 'video' ],
        //             ['clean']
        //         ]
        //     },
        //     bounds: '.content-inner',
        //     placeholder: 'Please add your text here...',
        //     theme: 'snow'
        // });

        // // Empty editor with placeholder
        // const quillPlaceholder = new Quill('.quill-placeholder', {
        //     bounds: '.content-inner',
        //     placeholder: 'Please add your text here...',
        //     theme: 'snow'
        // });

        // // Scrollable editor
        // const quillReadonly = new Quill('.quill-scrollable', {
        //     bounds: '.content-inner',
        //     scrollingContainer: 'quill-scrollable-container',
        //     placeholder: 'Please add your text here...',
        //     theme: 'snow'
        // });

        // const _handleFormSubmission = function() {
        //     const form = document.querySelector('.wizard-form');
        //     form.addEventListener('submit', function(event) {
        //         const petitumInput = document.getElementById('petitum-input');
        //         console.log(petitumInput); // Check if petitumInput is correctly selected
                
        //         const quillContent = document.querySelector('.quill-basic .ql-editor').innerHTML.trim();
        //         console.log(quillContent); // Check the content retrieved from Quill editor
                
        //         if (quillContent.length > 0) {
        //             petitumInput.value = quillContent;
        //         } else {
        //             event.preventDefault();
        //             alert('Mohon isi konten Petitum terlebih dahulu.');
        //         }
        //     });
        // };


    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _componentQuill();
            // _handleFormSubmission();
        }
    };
}();

// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function() {
    QuillEditor.init();
});
