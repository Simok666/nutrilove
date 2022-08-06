var base_url = window.location.origin;

function showModalDefault(title, table, url, newtab, view) {
	if (newtab == 1) {
		window.open(url, '_blank');
	} else {
		$("#primary").modal('show');
		$("#title").text(title);
		showData(table, url, view);
	}
}


function showData(table, url, view) {
	var data = {
		"table": table,
		"view": view,
		"_token": $('#token').val()
	};
	$.ajax({
		url: "/showtable/" + table,
		type: "POST",
		dataType: "JSON",
		data: data,
		success: function (data) {

			$("#isi-modal").html(data.html);
			$("#save").attr("onclick", "saveData('" + table + "','" + url + "','" + view + "')");
			$("#delete").attr("onclick", "deleteData('" + table + "','" + view + "')");

		}
	});
}

function saveData(table, url = '', view) {
	let check = validasi();

	if (!check) {
		url = (url == '') ? base_url + "/save/" + table : url;
		$(".overlay").removeClass("d-none");

		if ($("#desc_content ").length > 0) {
			for (instance in CKEDITOR.instances) {
				$('#' + instance).val(CKEDITOR.instances[instance].getData());
			}
		}

		let data = $("#form").serialize()
		console.log(data);
		$.ajax({
			url: url,
			type: "POST",
			dataType: "JSON",
			data: data,
			success: function (data) {
				showData(table, url, view);
				success();
			}
		});
	}
}


function info(message) {
	var Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 3000
	});
	toastr.info(message);
}

function validasi() {
	var error = false;
	var check = $(".validasi");
	for (var i = 0; i < check.length; i++) {

		if ($(check[i]).val() == "") {
			info($(check[i]).attr('id') + " Data Tidak Valid !");
			error = true;
		}
	}
	return error;
}

function success() {
	var Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 3000
	});

	Toast.fire({
		icon: 'success',
		title: 'Data Berhasil Disimpan !'
	})
}