<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.2/skins/ui/oxide/skin.min.css">

<link rel="stylesheet" href={{ asset('vendor/comments/css/app.css') }}>

<div class="new-comment-form mt-4">
    <div class="media mb-3">
        @if($user->hasMedia('avatars'))
        <img src="{{ $user?->getFirstMediaUrl('avatars') }}" class="mr-3 rounded-circle" alt="{{ $user?->name }}" width="50" height="50">
        @endif
        <div class="media-body">
            <h6 class="mt-0">{{ $user?->name }}</h6>
            <form method="POST" action="{{ route('comments.store', ['modelType' => class_basename($model), 'modelId' => $model->id]) }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <textarea id="content" name="content" class="form-control" rows="5" placeholder="Write your comment..." required>

                    </textarea>
                </div>
                <button type="submit" class="btn btn-primary" id="submitCommentBtn">{{ trans('Comment') }}</button>
            </form>
        </div>
    </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.2/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: 'textarea#content',
        plugins: 'advlist autolink lists link image charmap preview anchor emoticons textcolor',
        toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | emoticons | removeformat | link',
        menubar: false,
        file_picker_types: 'file',
        file_picker_callback: function (callback, value, meta) {
            // Create an input element for file selection
            const input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', '*'); // Accept any file type
            input.setAttribute('multiple', 'multiple'); // Allow multiple file selection

            input.onchange = function () {
                const files = Array.from(this.files); // Convert FileList to Array
                const fileInput = document.getElementById('fileInput');

                // Create a DataTransfer object to manage selected files
                const dataTransfer = new DataTransfer();

                // Append existing files from fileInput, if any
                Array.from(fileInput.files).forEach(file => dataTransfer.items.add(file));

                // Append new files to DataTransfer
                files.forEach(file => {
                    dataTransfer.items.add(file);

                    // Optional: add a preview or placeholder in TinyMCE content
                    callback(file.name, { text: file.name });
                });

                // Set the fileInput files to DataTransfer's files (preserves all selected files)
                fileInput.files = dataTransfer.files;
            };
            input.click();
        },
        setup: function (editor) {
            editor.on('change', function () {
                tinymce.triggerSave(); // Update textarea with TinyMCE content
            });
        },
        emoticons_append: {
            custom_mind_blown: {
                keywords: ['mind', 'blown'],
                char: '🤯'
            }
        }
    });



</script>
