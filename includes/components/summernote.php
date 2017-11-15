<!-- <textarea required class="form-control editor" col="8" rows="8" name="content" style="resize: none;" maxlength="50" placeholder="Uw bericht.."></textarea> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- summernote js -->
<script type="text/javascript" src="/js/summernote.min.js"></script>
<script src="/js/summernote-ext-emoji.js" charset="utf-8"></script>
<script>
document.emojiSource = "/images/emoji/"
$('.editor').summernote({
    disableResizeEditor: true,
    toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        ['misc', ['emoji']],
        ['code', ['codeview']],
        ['picture',['picture']]
    ],
    callbacks: {
        onImageUpload: handleImage
    }
});

function handleImage(files) {
    Array.from(files).forEach((x, i) => {
        var data = new FormData();
        data.append("file", files[i]);
        $.ajax({
            data: data,
            type: "POST",
            url: "/includes/tools/summernote_image_upload",
            cache: false,
            contentType: false,
            processData: false,
            success: function(url) {
                console.log(url)
                $('.editor').summernote('editor.insertImage', url);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(error)
            }
        });
    })
}

$(document).ready(function () {
    $('.quote-btn').on('click', function () {
        $('.editor').summernote('insertText', '[quote ' + ($(this).attr('data-id')) + ']')//.disabled = true
        document.emojiSource = '/images/emoji/';
    });
});
</script>
