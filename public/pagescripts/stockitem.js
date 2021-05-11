$(document).ready(function(){
	$(`#stockDetail_${item_id}`).on("shown.bs.modal", function () {
		$.ajax({
			url: uri,
			type: "GET",
			// data: $('#issueForm').serialize(),
			success: function (recordset) {
				// $("#apprvFrm").load(window.location.href + " #apprvFrmFooter");
				// $("#apprvTable").load(window.location.href + " #itemsTable");
				// location.reload();
				$(`#tbl_heading${item_id}`).siblings().remove();
				recordset.data.forEach((data, i) => {
					var i = i + 1;
					$(`#issueditems${item_id}`)
						.append(`<li class="list-group-item d-flex">
      <b class="col-md-2">${i}</b>
      <span class="col-md-5">${data.vehicle_no}</span> 
      <span class="col-md-5">${data.serial_no}</span>
      </li>`);
				});
			},
			error: function () {
				console.log("Fail");
			},
		});
		$(`#stockDetail_${item_id}`).on("hidden.bs.modal", function () {});
	})
})