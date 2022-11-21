// yajra datatbles
$(document).ready(function () {
    $("#kelas-table").DataTable({
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        ordering: true,
        serverSide: true,
        processing: true,
        ajax: {
            url: $("#tableKelas-url").val(),
        },
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                width: "10px",
                orderable: false,
                searchable: false,
            },
            { data: "kelas", name: "kelas" },
            {
                data: "options",
                name: "options",
                orderable: false,
                searchable: false,
            },
        ],
    });
});

$("#addKelas").on("click", function () {
    $("#staticBackdropLabelKelas").html(
        '<h5 class="modal-title" id="staticBackdropLabel"><strong class="text-dark">Tambah Data</strong> <strong class="text-warning">Kelas</strong></h5>'
    );
    $("#kelas").val(null);
    $("#save").text("Simpan");
});

$("#save").on("click", function () {
    if ($(this).text() === "Update") {
        edit();
    } else {
        add();
    }
});

// // panggil function edit berdasarkan id untuk menedit data
$(document).on("click", ".edit", function () {
    let id = $(this).attr("id");
    // buka modal nya untuk edit data
    $("#addKelas").click();
    // ubah button simpan jadi "update"
    $("#save").text("Update");
    // ubah text-header jadi edit
    $("#staticBackdropLabel").html(
        '<h5 class="modal-title" id="staticBackdropLabel"><strong class="text-dark">Edit Data</strong> <strong class="text-warning">Kelas</strong></h5>'
    );
    // data
    $.ajax({
        url: "/admin/kelas/edit",
        type: "post",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: {
            id: id,
        },
        success: function (res) {
            $("#id").val(res.data.id);
            $("#kelas").val(res.data.kelas);
        },
    });
    // ketika data tidak jadi di edit dan menekan tombol batal maka akan menjalankan function ini
    $("#close").on("click", function () {
        $("#save").text("Simpan");
        $("#kelas").val(null);
    });
});

// // function tambah data
function add() {
    $.ajax({
        url: "/admin/kelas/store",
        type: "post",
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: {
            kelas: $("#kelas").val(),
        },
        success: function (data) {
            Swal.fire({
                type: "success",
                icon: "success",
                title: "Data ditambah",
                showConfirmButton: false,
                timer: 3000,
            });

            $("#close").click();
            $("#kelas-table").DataTable().ajax.reload();
            $("#kelas").val(null);
        },
        error: function (data) {
            alert(data.responseJSON.message);
        },
    });
    $("#close").on("click", function () {
        $("#kelas-table").DataTable().ajax.reload();
        $("#save").text("Simpan");
        $("#kelas").val(null);
    });
}

// function update data
function edit() {
    $.ajax({
        url: "/admin/kelas/update",
        type: "post",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: {
            id: $("#id").val(),
            kelas: $("#kelas").val(),
        },
        success: function () {
            Swal.fire({
                type: "success",
                icon: "success",
                title: "Data diupdate",
                showConfirmButton: false,
                timer: 3000,
            });
            // jika sukses kosongkan modal form
            $("#close").click();
            $("#kelas-table").DataTable().ajax.reload();
            $("#kelas").val(null);
            $("#save").text("Simpan");
        },
        error: function (xhr) {
            alert(xhr.responseJSON.text);
            // jika gagal kosongkan modal form
            $("#close").click();
            $("#kelas-table").DataTable().ajax.reload();
            $("#kelas").val(null);
        },
    });
}

// panggil function delete berdasarkan id untuk hapus data
$(document).on("click", ".delete", function () {
    let id = $(this).attr("id");

    Swal.fire({
        title: "Apakah Kamu Yakin?",
        text: "Ingin menghapus data ini!",
        icon: "warning",
        showCancelButton: true,
        cancelButtonText: "Tidak",
        confirmButtonText: "Hapus!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/admin/kelas/delete",
                type: "post",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                data: {
                    id: id,
                    multi: null,
                },
                success: function (params) {
                    Swal.fire({
                        type: "success",
                        icon: "success",
                        title: "Data dihapus !",
                        showConfirmButton: false,
                        timer: 3000,
                    });
                    $("#kelas-table").DataTable().ajax.reload();
                },
            });
        }
    });
});
