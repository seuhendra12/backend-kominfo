function createClassicEditor(selector) {
    const textarea = document.querySelector(selector);
    if (textarea) {
        ClassicEditor.create(textarea)
            .catch((error) => {
                console.error(error);
            });
    } 
}

createClassicEditor('textarea[name="isi_konten"]');
createClassicEditor('textarea[name="isi_konten_eng"]');
createClassicEditor('textarea[name="deskripsi"]');
