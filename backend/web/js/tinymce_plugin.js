tinymce.PluginManager.add('bb_media', function(editor, url) {
    // Add a button that opens a window
    editor.addButton('bb_media', {
        text: 'Media',
        icon: false,
        onclick: function() {
            // Open window
            editor.windowManager.open({
                title: "Media",
                url: '/backend/media/tinymce',
                width: 1200,
                height: 600
            });
        }
    });
});