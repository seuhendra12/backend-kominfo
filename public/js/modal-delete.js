$(document).ready(function () {
    $("#confirm-delete-modal").on("show.bs.modal", function (e) {
        var roleId = $(e.relatedTarget).data("role-id");
        $(this)
            .find("form")
            .attr("action", function (index, value) {
                return value.replace("__role_id", roleId);
            });
    });
});

$(document).ready(function () {
    $("#confirm-delete-modal").on("show.bs.modal", function (e) {
        var permissionId = $(e.relatedTarget).data("permission-id");
        $(this)
            .find("form")
            .attr("action", function (index, value) {
                return value.replace("__permission_id", permissionId);
            });
    });
});

$(document).ready(function () {
    $("#confirm-delete-modal").on("show.bs.modal", function (e) {
        var tagId = $(e.relatedTarget).data("tag-id");
        $(this)
            .find("form")
            .attr("action", function (index, value) {
                return value.replace("__tag_id", tagId);
            });
    });
});

$(document).ready(function () {
    $("#confirm-delete-modal").on("show.bs.modal", function (e) {
        var kategoriId = $(e.relatedTarget).data("kategori-id");
        $(this)
            .find("form")
            .attr("action", function (index, value) {
                return value.replace("__kategori_id", kategoriId);
            });
    });
});

$(document).ready(function () {
    $("#confirm-delete-modal").on("show.bs.modal", function (e) {
        var galeriId = $(e.relatedTarget).data("galeri-id");
        $(this)
            .find("form")
            .attr("action", function (index, value) {
                return value.replace("__galeri_id", galeriId);
            });
    });
});

$(document).ready(function () {
    $("#confirm-delete-modal").on("show.bs.modal", function (e) {
        var kontenId = $(e.relatedTarget).data("konten-id");
        $(this)
            .find("form")
            .attr("action", function (index, value) {
                return value.replace("__konten_id", kontenId);
            });
    });
});

$(document).ready(function () {
    $("#confirm-delete-modal").on("show.bs.modal", function (e) {
        var unitKerjaId = $(e.relatedTarget).data("unitkerja-id");
        console.log(unitKerjaId);
        $(this)
            .find("form")
            .attr("action", function (index, value) {
                return value.replace("__unitKerja_id", unitKerjaId);
            });
    });
});

$(document).ready(function () {
    $("#confirm-delete-modal").on("show.bs.modal", function (e) {
        var halamanId = $(e.relatedTarget).data("halaman-id");
        console.log(halamanId);
        $(this)
            .find("form")
            .attr("action", function (index, value) {
                return value.replace("__halaman_id", halamanId);
            });
    });
});

$(document).ready(function () {
    $("#confirm-delete-modal").on("show.bs.modal", function (e) {
        var agendaId = $(e.relatedTarget).data("agenda-id");
        $(this)
            .find("form")
            .attr("action", function (index, value) {
                return value.replace("__agenda_id", agendaId);
            });
    });
});