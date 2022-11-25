// yajra datatbles
$(document).ready(function () {
    $("#info-table")
        .DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            ordering: true,
            serverSide: true,
            processing: true,
            ajax: {
                url: $("#table-url").val(),
            },
            columns: [
                {
                    data: "cek",
                    name: "cek",
                    orderable: false,
                    searchable: false,
                },
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    width: "10px",
                    orderable: false,
                    searchable: false,
                },
                { data: "tanggal", name: "tanggal" },
                { data: "waktu", name: "waktu" },
                { data: "judul", name: "judul" },
                { data: "kelas.kelas", name: "kelas.kelas" },
                { data: "deskripsi", name: "deskripsi" },
                { data: "status", name: "status" },
                {
                    data: "options",
                    name: "options",
                    orderable: false,
                    searchable: false,
                },
            ],
        })
        .on("draw", function () {
            $('input[name="checkbox"]').each(function () {
                this.checked = false;
            });
            $('input[name="main_checkbox"]').prop("checked", false);
            $("#deleteInfo").addClass("d-none");
        });
});

// kosongkan filed tambah jadwal
$("#addInfo").on("click", function () {
    $("#staticBackdropLabel").html(
        '<h5 class="modal-title" id="staticBackdropLabelInfo"><strong class="text-dark">Tambah</strong> <strong class="text-warning">Pengumuman / Info</strong></h5>'
    );
    $("#tanggal").val(null);
    $("#waktu").val(null);
    $("#judul").val(null);
    $("#kelas_id").val(null);
    $("#deskripsi").val(null);
    $("#status").val(null);
    $("#save").text("Simpan");
});

$("#save").on("click", function () {
    if ($(this).text() === "Update") {
        edit();
    } else {
        add();
    }
});

// panggil function edit berdasarkan id untuk menedit data
$(document).on("click", ".edit", function () {
    let id = $(this).attr("id");
    // buka modal nya untuk edit data
    $("#addInfo").click();
    // ubah button simpan jadi "update"
    $("#save").text("Update");
    // ubah text-header jadi edit
    $("#staticBackdropLabelInfo").html(
        '<h5 class="modal-title" id="staticBackdropLabel"><strong class="text-dark">Edit Data</strong> <strong class="text-warning">Jadwal</strong></h5>'
    );
    // data
    $.ajax({
        url: "/admin/info/edit",
        type: "post",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: {
            id: id,
        },
        success: function (res) {
            $("#id").val(res.data.id);
            $("#tanggal").val(res.data.tanggal);
            $("#waktu").val(res.data.waktu);
            $("#judul").val(res.data.judul);
            $("#kelas_id").val(res.data.kelas_id);
            $("#deskripsi").val(res.data.deskripsi);
            $("#status").val(res.data.status);
        },
    });
    // ketika data tidak jadi di edit dan menekan tombol batal maka akan menjalankan function ini
    $("#close").on("click", function () {
        $("#save").text("Simpan");
        $("#tanggal").val(null);
        $("#waktu").val(null);
        $("#judul").val(null);
        $("#kelas_id").val(null);
        $("#deskripsi").val(null);
        $("#status").val(null);
    });
});

// function tambah data
function add() {
    let user_id = $(this).data("user_id");
    $.ajax({
        url: "/admin/info/store",
        type: "post",
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: {
            tanggal: $("#tanggal").val(),
            waktu: $("#waktu").val(),
            judul: $("#judul").val(),
            kelas_id: $("#kelas_id").val(),
            user_id: user_id,
            deskripsi: $("#deskripsi").val(),
            status: $("#status").val(),
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
            $("#info-table").DataTable().ajax.reload();
            $("#tanggal").val(null);
            $("#waktu").val(null);
            $("#judul").val(null);
            $("#kelas_id").val(null);
            $("#deskripsi").val(null);
            $("#status").val(null);
        },
        error: function (data) {
            alert(data.responseJSON.message);
        },
    });
    $("#close").on("click", function () {
        $("#save").text("Simpan");
        $("#tanggal").val(null);
        $("#waktu").val(null);
        $("#judul").val(null);
        $("#kelas_id").val(null);
        $("#deskripsi").val(null);
        $("#status").val(null);
    });
}

// function update data
function edit() {
    $.ajax({
        url: "/admin/info/update",
        type: "post",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: {
            id: $("#id").val(),
            tanggal: $("#tanggal").val(),
            waktu: $("#waktu").val(),
            judul: $("#judul").val(),
            kelas_id: $("#kelas_id").val(),
            deskripsi: $("#deskripsi").val(),
            status: $("#status").val(),
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
            $("#info-table").DataTable().ajax.reload();
            $("#tanggal").val(null);
            $("#waktu").val(null);
            $("#judul").val(null);
            $("#kelas_id").val(null);
            $("#deskripsi").val(null);
            $("#status").val(null);
            $("#save").text("Simpan");
        },
        error: function (xhr) {
            alert(xhr.responseJSON.text);
            // jika gagal kosongkan modal form
            $("#close").click();
            $("#info-table").DataTable().ajax.reload();
            $("#tanggal").val(null);
            $("#waktu").val(null);
            $("#judul").val(null);
            $("#kelas_id").val(null);
            $("#deskripsi").val(null);
            $("#status").val(null);
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
                url: "/admin/info/delete",
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
                    $("#info-table").DataTable().ajax.reload();
                },
            });
        }
    });
});

// function select checkbox
$(document).on("click", 'input[name="main_checkbox"]', function () {
    if (this.checked) {
        $('input[name="checkbox"]').each(function () {
            this.checked = true;
        });
    } else {
        $('input[name="checkbox"]').each(function () {
            this.checked = false;
        });
    }
    multipleDelete();
});

// function ketika semua check box terselect maka otomatis check pada header (checkall) menyala
$(document).on("change", 'input[name="checkbox"]', function () {

    if ($('input[name="checkbox"]').length == $('input[name="checkbox"]:checked').length) {
        $('input[name="main_checkbox"]').prop("checked", true);
    } else {
        $('input[name="main_checkbox"]').prop("checked", false);
    }
    multipleDelete();
});

// tampilka multiple delete button apabila checkbox terselect
function multipleDelete() {
    if ($('input[name="checkbox"]:checked').length > 0) {
        $("#deleteInfo").text("Hapus ("+$('input[name="checkbox"]:checked').length +") Data")
            .removeClass("d-none");
    } else {
        $("#deleteInfo").addClass("d-none");
    }
}

// function multi delete
$(document).on('click','#deleteInfo',function(){
    let checkedAll=[];
      $('input[name="checkbox"]:checked').each(function(){
        checkedAll.push($(this).attr('id'));
    });
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
                        url: "/admin/info/delete",
                        type: "post",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        data: {
                            data: checkedAll,
                            multi: 1,
                        },
                        success: function (params) {
                            Swal.fire({
                                type: "success",
                                icon: "success",
                                title: "Data dihapus !",
                                showConfirmButton: false,
                                timer: 3000,
                            });
                            $("#info-table").DataTable().ajax.reload();
                        },
                    });
                }
            });

});
