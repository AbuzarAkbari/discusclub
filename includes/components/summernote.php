<textarea required class="form-control editor" col="8" rows="8" name="reply_content" style="resize: none;" maxlength="50" placeholder="Uw bericht.."></textarea>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- summernote js -->
<script type="text/javascript" src="/js/summernote.min.js"></script>
<script src="/js/summernote-ext-emoji.js" charset="utf-8"></script>
<script>
document.emojiSource = '/images/emoji/';
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
    ]
});

$(document).ready(function () {
    $('.quote-btn').on('click', function () {
        $('.editor').summernote('insertText', '[quote ' + ($(this).attr('data-id')) + ']')//.disabled = true
    });
});
</script>
