let Result = [];

function change_fieldset(prev, next) {
	$("#fieldset_" + prev).fadeOut(1000, function () {
		$("#fieldset_" + next).fadeIn(1000);
	});
}


function enviar() {
	Result = [];
	elements = $("#form");
	jsonF = JSON.stringify(Result);
	$("#json-field").val(elements.html());
	$("#form").submit();
}

function toPDF(e) {
	var element = document.getElementById("form");

	var opt = {
		image: { type: "jpeg", quality: 0.98 },
		html2canvas: { scale: 4 },
		jsPDF: { unit: "cm", format: "letter", orientation: "portrait" }, //orientation: 'landscape'
	};

	try {
		html2pdf()
			.from(element)
			.set(opt)
			.toPdf()
			.output("datauristring")
			.then(function (pdfAsString) {
				var arr = pdfAsString.split(",");
				pdfAsString = arr[1];
				$("#json-field").val(pdfAsString);
				$("#form").submit();
			});
	} catch (e) {
		console.log(e);
	}
}

$(document).ready(function () {
	$("#fieldset_1").show();
	$("input:radio").change(function () {
		$($(this).attr("name")).attr("checked", false);
		$(this).attr("checked", true);
	});
	$("input:checkbox").change(function () {
		$(this).attr("checked", true);
	});
});
