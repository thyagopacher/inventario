tinymce.init({
  selector: ".texto",
  language: "pt_BR",
  language_url: './recursos/js/tinymce/langs/pt_BR.js',
  plugins: [
    "advlist autolink lists link image charmap print preview anchor",
    "searchreplace visualblocks code fullscreen",
    "insertdatetime media table contextmenu paste jbimages  textcolor colorpicker"
  ],	
  toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages | print preview | forecolor backcolor emoticons",
  relative_urls: false,
   setup: function (editor) {
        editor.on('change', function () {
            tinymce.triggerSave();
        });
    } 	
});
function inserirTexto2() {
    tinymce.activeEditor.setContent(tinymce.activeEditor.getContent() + '[local]');
}

