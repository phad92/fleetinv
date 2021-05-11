$(`#re-issueModal_${item_id}`).on("shown.bs.modal", function () {
	$(".form1").remove();
	// console.log(`${base_url}requestlist/getserialno/${item_id}`);
	$.ajax({
		url: `${base_url}vehicle/getVehicleJson`,
		data: { vehicle_id },
		type: "GET",
		success: function (resultset) {
			// console.log(resultset.data);
			if (resultset.message == "success") {
				resultset.data.forEach((data, i) => {
					$(`#re-issueForm${item_id}`)
						.append(`<div class="form-row form1" id="test${i}">
                            <div class="col-md-2">
                                <strong>Serial# </strong>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="text" form="issueForm<?php echo $item->id?>" value="${data}" class="form-control" placeholder="Provide Serial Number" name="serial_no[]";>
                                </div>
                            </div>
                        </div>`);
				});
			}
		},
		error: function () {
			console.log("failed");
		},
	});
});


    $(`#addBtn${item_id}`).click(() => {
			qty = parseInt(qty) + 1;

			$(`#aj_qty${item_id}`).val(qty);

			$(`#re-issueForm${item_id}`)
				.append(`<div class="form-row form1" id="test">
                <div class="col-md-2">
                    <strong>Serial# </strong>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <input type="text" form="issueForm<?php echo $item->id?>" class="form-control" placeholder="Provide Serial Number" name="serial_no[]";>
                    </div>
                </div>
                </div>`);
		});


        
     $(`#aj_qty${item_id}`).change(() => {
				$(".form1").remove();

				var qty = $(`#aj_qty${item_id}`).val();
				var i = 0;

				// $('#assignForm1').append('<h4>Provide Serial Numbers Below</h4>')
				for (var i = 0; i < qty; i++) {
					$(`#re-issueForm${item_id}`)
						.append(`<div class="form-row form1" id="test">
                <div class="col-md-2">
                    <strong>Serial# </strong>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <input type="text" form="issueForm<?php echo $item->id?>" class="form-control" placeholder="Provide Serial Number" name="serial_no[]";>
                    </div>
                </div>
                    <div class="col-md-2">
                        <button class="btn btn-sm btn-danger rmserial">X ${i}</button>
                    </div>
                </div>`);
				}
			});


            $("#issueFormbtn" + item_id).click(() => {
							console.log($("#issueForm" + item_id).serializeArray());
						});