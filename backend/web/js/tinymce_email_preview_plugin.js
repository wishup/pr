tinymce.PluginManager.add('bb_email_preview', function(editor, url) {
    // Add a button that opens a window
    editor.addButton('bb_email_preview', {
        text: 'Preview Email',
        icon: false,
        onclick: function() {
            // Open window
            editor.windowManager.open({
                title: "Preview Email",
                url: '/backend/mailingtemplates/preview',
                width: 1200,
                height: 600
            });
        }
    });
});