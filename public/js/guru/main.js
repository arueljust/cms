// yajra datatles
$(document).ready(function () {
    $("#guru-table").DataTable({
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
                width: "10px",
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
            { data: "nama", name: "nama" },
            { data: "alamat", name: "alamat" },
            { data: "no_telp", name: "no_telp" },
            { data: "jenis_kelamin", name: "jenis_kelamin" },

            {
                data: "options",
                name: "options",
                orderable: false,
                searchable: false,
            },
        ],
    }).on('draw',function(){
        $('input[name="checkbox"]').each(function(){this.checked=false;});
        $('input[name="main_checkbox"]').prop('checked',false);
        $('#deleteGuru').addClass('d-none');
    })
});

$("#addGuru").on("click", function () {
    $("#staticBackdropLabelGuru").html(
        '<h5 class="modal-title" id="staticBackdropLabel"><strong class="text-dark">Tambah Data</strong> <strong class="text-warning">Guru</strong></h5>'
    );
    $("#nama").val(null);
    $("#alamat").val(null);
    $("#ttl").val(null);
    $("#no_telp").val(null);
    $("#jenis_kelamin").val(null);
    $("#foto").val(null);
    $("#sertifikat").val(null);
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
    $("#addGuru").click();
    // ubah button simpan jadi "update"
    $("#save").text("Update");
    // ubah text-header jadi edit
    $("#staticBackdropLabelGuru").html(
        '<h5 class="modal-title" id="staticBackdropLabel"><strong class="text-dark">Edit Data</strong> <strong class="text-warning">Guru</strong></h5>'
    );
    // data
    $.ajax({
        url: "/admin/guru/edit",
        type: "post",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: {
            id: id,
        },
        success: function (res) {
            $("#id").val(res.data.id);
            $("#nama").val(res.data.nama);
            $("#alamat").val(res.data.alamat);
            $("#ttl").val(res.data.ttl);
            $("#no_telp").val(res.data.no_telp);
            $("#jenis_kelamin").val(res.data.jenis_kelamin);
            $("#foto").val(res.data.foto);
            $("#sertifikat").val(res.data.sertifikat);
        },
    });
    // ketika data tidak jadi di edit dan menekan tombol batal maka akan menjalankan function ini
    $("#close").on("click", function () {
        $("#save").text("Simpan");
        $("#nama").val(null);
        $("#alamat").val(null);
        $("#ttl").val(null);
        $("#no_telp").val(null);
        $("#jenis_kelamin").val(null);
        $("#foto").val(null);
        $("#sertifikat").val(null);
    });
});

// function tambah data
function add() {
    $.ajax({
        url: "/admin/guru/store",
        type: "post",
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: {
            nama: $("#nama").val(),
            alamat: $("#alamat").val(),
            ttl: $("#ttl").val(),
            no_telp: $("#no_telp").val(),
            jenis_kelamin: $("#jenis_kelamin").val(),
            foto: $("#foto").val(),
            sertifikat: $("#sertifikat").val(),
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
            $("#guru-table").DataTable().ajax.reload();
            $("#nama").val(null);
            $("#alamat").val(null);
            $("#ttl").val(null);
            $("#no_telp").val(null);
            $("#jenis_kelamin").val(null);
            $("#foto").val(null);
            $("#sertifikat").val(null);
        },
        error: function (data) {
            alert(data.responseJSON.message);
        },
    });
    $("#close").on("click", function () {
        $("#save").text("Simpan");
        $("#nama").val(null);
        $("#alamat").val(null);
        $("#ttl").val(null);
        $("#no_telp").val(null);
        $("#jenis_kelamin").val(null);
        $("#foto").val(null);
        $("#sertifikat").val(null);
    });
}

// // function update data
function edit() {
    $.ajax({
        url: "/admin/guru/update",
        type: "post",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: {
            id: $("#id").val(),
            nama: $("#nama").val(),
            alamat: $("#alamat").val(),
            ttl: $("#ttl").val(),
            no_telp: $("#no_telp").val(),
            jenis_kelamin: $("#jenis_kelamin").val(),
            foto: $("#foto").val(),
            sertifikat: $("#sertifikat").val(),
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
            $("#guru-table").DataTable().ajax.reload();
            $("#nama").val(null);
            $("#alamat").val(null);
            $("#ttl").val(null);
            $("#no_telp").val(null);
            $("#jenis_kelamin").val(null);
            $("#foto").val(null);
            $("#sertifikat").val(null);
            $("#save").text("Simpan");
        },
        error: function (xhr) {
            alert(xhr.responseJSON.text);
            // jika gagal kosongkan modal form
            $("#close").click();
            $("#nama").val(null);
            $("#alamat").val(null);
            $("#ttl").val(null);
            $("#no_telp").val(null);
            $("#jenis_kelamin").val(null);
            $("#foto").val(null);
            $("#sertifikat").val(null);
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
                url: "/admin/guru/delete",
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
                    $("#guru-table").DataTable().ajax.reload();
                    // document.getElementById("deleteGuru").style.visibility =
                    //     "hidden";
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
        $("#deleteGuru").text("Hapus ("+$('input[name="checkbox"]:checked').length +") Data")
            .removeClass("d-none");
    } else {
        $("#deleteGuru").addClass("d-none");
    }
}

// function multi delete
$(document).on('click','#deleteGuru',function(){
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
                        url: "/admin/guru/delete",
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
                            $("#guru-table").DataTable().ajax.reload();
                        },
                    });
                }
            });

});
