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

const ReloadDataTable = (selector) => $(selector).DataTable().ajax.reload();;

function submitData(selectorform, url, successfunc, errorfunc) {
	successfunc = (typeof successfunc !== 'undefined') ? successfunc : "";
	errorfunc = (typeof errorfunc !== 'undefined') ? errorfunc : "";
	var formdata = $(selectorform).serialize();
	$.ajax({
		type: "POST",
		url: base_url + url,
		data: formdata,
		dataType: "JSON",
		tryCount: 0,
		retryLimit: 3,
		success: function (resp) {
			if (resp.IsError == false) {
				toastrshow("success", "Data berhasil disimpan", "Success");
				$(selectorform).parents(".modal").modal("hide"); //Tutup modal
				resetForm(selectorform) // Reset Form
				if (successfunc != "") {
					successfunc(resp);
				}
			} else {
				toastrshow("error", resp.Message, "Error");
				if (errorfunc != "") {
					errorfunc(resp);
				}
			}
		},
		error: function (xhr, textstatus, errorthrown) {
			setTimeout(function () {
				// $(".modal").modal("hide");
				toastrshow("warning", "Ops.! Something wrong.", "Peringatan");
			}, 500);
		}
	});
}

const ajaxData = (url, data, successfunc, errorfunc, beforefunc) => {
	successfunc = (typeof successfunc !== 'undefined') ? successfunc : "";
	errorfunc = (typeof errorfunc !== 'undefined') ? errorfunc : "";
	beforefunc = (typeof beforefunc !== 'undefined') ? beforefunc : "";
	$.ajax({
		type: "POST",
		url: url,
		data: data,
		dataType: "JSON",
		beforeSend: function () {
			if (!empty(beforefunc)) {
				beforefunc()
			}
		},
		tryCount: 0,
		retryLimit: 3,
		success: function (resp) {
			if (resp.IsError == false) {
				if (successfunc != "") {
					successfunc(resp);
				}
			} else {
				toastrshow("error", resp.Message, "Error");
				if (errorfunc != "") {
					errorfunc();
				}
			}
		},
		error: function (xhr, textstatus, errorthrown) {
			if (textstatus == "timeout") {
				this.tryCount++;
				if (this.tryCount <= this.retryLimit) {
					$.ajax(this);
				}
			} else {
				toastrshow("warning", "Ops.! Something wrong.", "Peringatan");
				if (!empty(errorfunc)) {
					errorfunc();
				}
			}
		}
	});
}

function Change_file($file) {
	return base_url + "/file/" + $file;
}

$(".no , input[type=number] ").attr("onkeypress", "return isNumber(event)");

$(".loading-gif-image").attr('src', base_url + "/assets/img/loading-data.gif");

function isNumber(evt) {
	evt = (evt) ? evt : window.event;
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		return false;
	}
	return true;
}

function hideModal(selector) {
	setTimeout(() => {
		$(selector).modal("hide")
	}, 1000);
}

const showLoading = (selector, show) => {
	if (show) $(selector).find(".loading").removeClass("d-none");
	else $(selector).find(".loading").addClass("d-none");
}

const hiddenComponent = (selector, show) => {
	if (show) $(selector).addClass("d-none");
	else $(selector).removeClass("d-none");
}

function in_array(search, array, column) {
	if (empty(column)) {
		column = "";
	}

	var length = array.length;
	for (var i = 0; i < length; i++) {
		if (!empty(column)) {
			if (array[i][column] == search) return true;
		} else {
			if (array[i] == search) return true;
		}
	}
	return false;
}

function empty(string) {
	return (string == undefined || string == "" || string == null);
}

function resetvalue(selector) {
	$(selector).find("select").val("").trigger("change");
	$(selector).find("input").val("");
}

function toastrshow(type, title, message) {
	message = (typeof message !== 'undefined') ? message : "";
	toastr.options = {
		closeButton: true,
		progressBar: true,
		showMethod: "slideDown",
		positionClass: "toast-top-right",
		timeOut: 3000,
		onclick: null,
		showMethod: "fadeIn",
		hideMethod: "fadeOut",
	}
	switch (type) {
		case "success": toastr["success"](title, message); break;
		case "info": toastr["info"](title, message); break;
		case "warning": toastr["warning"](title, message); break;
		case "error": toastr["error"](title, message); break;
		default: toastr["info"](title, message); break;
	}
}

const resetForm = (selector) => $(selector).find("input,select,textarea").not("[type=radio]").val("").trigger("change")

$(document).ajaxComplete(function (event, request, settings) {
	try {
		feather.replace()
	} catch (error) {
		console.log("Feather icons not found")
	}
});

$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN':  $('meta[name="csrf-token"]').attr('content') }
});

const initDatatable = (selector , columns = {} , settings = {}) => {
	let tableSelector = $(selector);
	let settingsDatatable = {
		processing: true,
		responsive: true,
		serverSide: true,
		ajax: tableSelector.attr("urlAjax"), // memanggil route yang menampilkan data json
	}

	if (columns != {} ) {
		settingsDatatable.columns = columns
	}

	if (settings != {}) {
		$.each(settings, function (index, item) { 
			settingsDatatable[index] = item
		});
	}

	setTimeout(() => {
		let dataTable = $(selector).DataTable(
			settingsDatatable
		);
	}, 500);
}
