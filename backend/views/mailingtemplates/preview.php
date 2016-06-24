<?=  \common\components\Email::renderFromText('<div id="preview_content"></div>', 1); ?>

<script>
    document.getElementById("preview_content").innerHTML = top.tinymce.activeEditor.getContent();
</script>