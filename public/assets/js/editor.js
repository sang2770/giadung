if (document.querySelector('#editor')) {
    CKEDITOR.replace('editor');
}

$(function () {
    $("#myFile").on("change", function (e) {
        const [file] = this.files;
        if (file) {
            $("#imgpreview img").attr('src', URL.createObjectURL(file));
            $("#imgpreview").show();
        }
    });
});
