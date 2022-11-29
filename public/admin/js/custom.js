$(document).ready(function () {
	//datatables
	$("#ssDataTable").DataTable();

	//Check Admin Password is correct or not
	$("#current_password").keyup(function () {
		var current_password = $("#current_password").val();
		//alert(current_password);
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: 'post',
			url: '/admin/check-admin-password',
			data: { current_password: current_password },
			success: function (response) {
				if (response == "false") {
					$("#check_password").html("<font color='red'>Current Password is Incorrect!</font>");
				} else if (response == "true") {
					$("#check_password").html("<font color='green'>Current Password is Correct!</font>");
				}
			},
			error: function () {
				alert("error");
			}
		});
	});

	//Update Admin Status
	$(document).on("click", ".updateAdminStatus", function () {
		var status = $(this).children("i").attr("status");
		var admin_id = $(this).attr("admin_id");
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: 'post',
			url: '/admin/update-admin-status',
			data: { status: status, admin_id: admin_id },
			success: function (response) {
				if (response['status'] == 0) {
					$("#admin-" + admin_id).html("<i style='font-size: 1.5rem;' class='mdi mdi-bookmark-outline' status='Inactive'></i>");
				} else if (response['status'] == 1) {
					$("#admin-" + admin_id).html("<i style='font-size: 1.5rem;' class='mdi mdi-bookmark-check' status='Active'></i>");
				}
			},
			error: function () {
				alert("error");
			}
		});
	});
	//Update Customer Status
	$(document).on("click", ".updateCustomerStatus", function () {
		var status = $(this).children("i").attr("status");
		var customer_id = $(this).attr("customer_id");
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: 'post',
			url: '/admin/update-customer-status',
			data: { status: status, customer_id: customer_id },
			success: function (response) {
				if (response['status'] == 0) {
					$("#customer-" + customer_id).html("<i style='font-size: 1.5rem;' class='mdi mdi-bookmark-outline' status='Inactive'></i>");
				} else if (response['status'] == 1) {
					$("#customer-" + customer_id).html("<i style='font-size: 1.5rem;' class='mdi mdi-bookmark-check' status='Active'></i>");
				}
			},
			error: function () {
				alert("error");
			}
		});
	});
	//Update Subscriber Status
	$(document).on("click", ".updateSubscriberStatus", function () {
		var status = $(this).children("i").attr("status");
		var subscriber_id = $(this).attr("subscriber_id");
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: 'post',
			url: '/admin/update-subscriber-status',
			data: { status: status, subscriber_id: subscriber_id },
			success: function (response) {
				if (response['status'] == 0) {
					$("#subscriber-" + subscriber_id).html("<i style='font-size: 1.5rem;' class='mdi mdi-bookmark-outline' status='Inactive'></i>");
				} else if (response['status'] == 1) {
					$("#subscriber-" + subscriber_id).html("<i style='font-size: 1.5rem;' class='mdi mdi-bookmark-check' status='Active'></i>");
				}
			},
			error: function () {
				alert("error");
			}
		});
	});
	//Update Section Status
	$(document).on("click", ".updateSectionStatus", function () {
		var status = $(this).children("i").attr("status");
		var section_id = $(this).attr("section_id");
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: 'post',
			url: '/admin/update-section-status',
			data: { status: status, section_id: section_id },
			success: function (response) {
				if (response['status'] == 0) {
					$("#section-" + section_id).html("<i style='font-size: 1.5rem;' class='mdi mdi-bookmark-outline' status='Inactive'></i>");
				} else if (response['status'] == 1) {
					$("#section-" + section_id).html("<i style='font-size: 1.5rem;' class='mdi mdi-bookmark-check' status='Active'></i>");
				}
			},
			error: function () {
				alert("error");
			}
		});
	});

	//Update Brand Status
	$(document).on("click", ".updateBrandStatus", function () {
		var status = $(this).children("i").attr("status");
		var brand_id = $(this).attr("brand_id");
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: 'post',
			url: '/admin/update-brand-status',
			data: { status: status, brand_id: brand_id },
			success: function (response) {
				if (response['status'] == 0) {
					$("#brand-" + brand_id).html("<i style='font-size: 1.5rem;' class='mdi mdi-bookmark-outline' status='Inactive'></i>");
				} else if (response['status'] == 1) {
					$("#brand-" + brand_id).html("<i style='font-size: 1.5rem;' class='mdi mdi-bookmark-check' status='Active'></i>");
				}
			},
			error: function () {
				alert("error");
			}
		});
	});

	//Update Category Status
	$(document).on("click", ".updateCategoryStatus", function () {
		var status = $(this).children("i").attr("status");
		var category_id = $(this).attr("category_id");
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: 'post',
			url: '/admin/update-category-status',
			data: { status: status, category_id: category_id },
			success: function (response) {
				if (response['status'] == 0) {
					$("#category-" + category_id).html("<i style='font-size: 1.5rem;' class='mdi mdi-bookmark-outline' status='Inactive'></i>");
				} else if (response['status'] == 1) {
					$("#category-" + category_id).html("<i style='font-size: 1.5rem;' class='mdi mdi-bookmark-check' status='Active'></i>");
				}
			},
			error: function () {
				alert("error");
			}
		});
	});

	//Update Product Status
	$(document).on("click", ".updateProductStatus", function () {
		var status = $(this).children("i").attr("status");
		var product_id = $(this).attr("product_id");
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: 'post',
			url: '/admin/update-product-status',
			data: { status: status, product_id: product_id },
			success: function (response) {
				if (response['status'] == 0) {
					$("#product-" + product_id).html("<i style='font-size: 1.5rem;' class='mdi mdi-bookmark-outline' status='Inactive'></i>");
				} else if (response['status'] == 1) {
					$("#product-" + product_id).html("<i style='font-size: 1.5rem;' class='mdi mdi-bookmark-check' status='Active'></i>");
				}
			},
			error: function () {
				alert("error");
			}
		});
	});

	//Update Product Filter Status
	$(document).on("click", ".updateFilterStatus", function () {
		var status = $(this).children("i").attr("status");
		var filter_id = $(this).attr("filter_id");
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: 'post',
			url: '/admin/update-filter-status',
			data: { status: status, filter_id: filter_id },
			success: function (response) {
				if (response['status'] == 0) {
					$("#filter-" + filter_id).html("<i style='font-size: 1.5rem;' class='mdi mdi-bookmark-outline' status='Inactive'></i>");
				} else if (response['status'] == 1) {
					$("#filter-" + filter_id).html("<i style='font-size: 1.5rem;' class='mdi mdi-bookmark-check' status='Active'></i>");
				}
			},
			error: function () {
				alert("error");
			}
		});
	});
	//Update Product Filter Status
	$(document).on("click", ".updateFilterValueStatus", function () {
		var status = $(this).children("i").attr("status");
		var filter_id = $(this).attr("filter_id");
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: 'post',
			url: '/admin/update-filter-value-status',
			data: { status: status, filter_id: filter_id },
			success: function (response) {
				if (response['status'] == 0) {
					$("#filter-" + filter_id).html("<i style='font-size: 1.5rem;' class='mdi mdi-bookmark-outline' status='Inactive'></i>");
				} else if (response['status'] == 1) {
					$("#filter-" + filter_id).html("<i style='font-size: 1.5rem;' class='mdi mdi-bookmark-check' status='Active'></i>");
				}
			},
			error: function () {
				alert("error");
			}
		});
	});

	//Update Attribute Status
	$(document).on("click", ".updateAttributeStatus", function () {
		var status = $(this).children("i").attr("status");
		var attribute_id = $(this).attr("attribute_id");
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: 'post',
			url: '/admin/update-attribute-status',
			data: { status: status, attribute_id: attribute_id },
			success: function (response) {
				if (response['status'] == 0) {
					$("#attribute-" + attribute_id).html("<i style='font-size: 1.5rem;' class='mdi mdi-bookmark-outline' status='Inactive'></i>");
				} else if (response['status'] == 1) {
					$("#attribute-" + attribute_id).html("<i style='font-size: 1.5rem;' class='mdi mdi-bookmark-check' status='Active'></i>");
				}
			},
			error: function () {
				alert("error");
			}
		});
	});

	//Update Image Status
	$(document).on("click", ".updateImageStatus", function () {
		var status = $(this).children("i").attr("status");
		var image_id = $(this).attr("image_id");
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: 'post',
			url: '/admin/update-image-status',
			data: { status: status, image_id: image_id },
			success: function (response) {
				if (response['status'] == 0) {
					$("#image-" + image_id).html("<i style='font-size: 1.5rem;' class='mdi mdi-bookmark-outline' status='Inactive'></i>");
				} else if (response['status'] == 1) {
					$("#image-" + image_id).html("<i style='font-size: 1.5rem;' class='mdi mdi-bookmark-check' status='Active'></i>");
				}
			},
			error: function () {
				alert("error");
			}
		});
	});
	//Update Faq Category Status
	$(document).on("click", ".updateFaqCategoryStatus", function () {
		var status = $(this).children("i").attr("status");
		var faq_category_id = $(this).attr("faq_category_id");
		//console.log(faq_id);
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: 'post',
			url: '/admin/update-faqCategory-status',
			data: { status: status, faq_category_id: faq_category_id },
			success: function (response) {
				if (response['status'] == 2) {
					$("#faqCategory-" + faq_category_id).html("<i style='font-size: 1.5rem;' class='mdi mdi-bookmark-outline' status='Inactive'></i>");
				} else if (response['status'] == 1) {
					$("#faqCategory-" + faq_category_id).html("<i style='font-size: 1.5rem;' class='mdi mdi-bookmark-check' status='Active'></i>");
				}
			},
			error: function () {
				alert("error");
			}
		});
	});
	//Update Faq Status
	$(document).on("click", ".updateFaqStatus", function () {
		var status = $(this).children("i").attr("status");
		var faq_id = $(this).attr("faq_id");
		//console.log(faq_id);
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: 'post',
			url: '/admin/update-faq-status',
			data: { status: status, faq_id: faq_id },
			success: function (response) {
				if (response['status'] == 2) {
					$("#faq-" + faq_id).html("<i style='font-size: 1.5rem;' class='mdi mdi-bookmark-outline' status='Inactive'></i>");
				} else if (response['status'] == 1) {
					$("#faq-" + faq_id).html("<i style='font-size: 1.5rem;' class='mdi mdi-bookmark-check' status='Active'></i>");
				}
			},
			error: function () {
				alert("error");
			}
		});
	});
	//Update Tax Status
	$(document).on("click", ".updateTaxStatus", function () {
		var status = $(this).children("i").attr("status");
		var tax_id = $(this).attr("tax_id");
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: 'post',
			url: '/admin/update-tax-status',
			data: { status: status, tax_id: tax_id },
			success: function (response) {
				if (response['status'] == 0) {
					$("#tax-" + tax_id).html("<i style='font-size: 1.5rem;' class='mdi mdi-bookmark-outline' status='Inactive'></i>");
				} else if (response['status'] == 1) {
					$("#tax-" + tax_id).html("<i style='font-size: 1.5rem;' class='mdi mdi-bookmark-check' status='Active'></i>");
				}
			},
			error: function () {
				alert("error");
			}
		});
	});
	//Update Shipping rule Status
	$(document).on("click", ".updateShippingRuleStatus", function () {
		var status = $(this).children("i").attr("status");
		var rule_id = $(this).attr("rule_id");
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: 'post',
			url: '/admin/update-shippingRule-status',
			data: { status: status, rule_id: rule_id },
			success: function (response) {
				if (response['status'] == 0) {
					$("#rule-" + rule_id).html("<i style='font-size: 1.5rem;' class='mdi mdi-bookmark-outline' status='Inactive'></i>");
				} else if (response['status'] == 1) {
					$("#rule-" + rule_id).html("<i style='font-size: 1.5rem;' class='mdi mdi-bookmark-check' status='Active'></i>");
				}
			},
			error: function () {
				alert("error");
			}
		});
	});
	//Confirm Deletation (sweet Alert Library)
	$(document).on("click", ".confirmDelete", function () {
		var module = $(this).attr('module');
		var moduleId = $(this).attr('moduleid');
		Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.isConfirmed) {
				Swal.fire(
					'Deleted!',
					'Your file has been deleted.',
					'success'
				)
				window.location = "/admin/delete-" + module + "/" + moduleId;
			}
		})
	});
	// $(".confirmDelete").click(function(){
	// 	var title = $(this).attr("title");
	// 	if (confirm("Are you sure to delete this "+title+"?" )) {
	// 		return true;
	// 	}else{
	// 		return false;
	// 	}
	// });

	//Append Categories Level
	$("#section_id").change(function () {
		var section_id = $(this).val();
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: '/admin/append-categories-level',
			type: 'get',
			data: { section_id: section_id },
			success: function (response) {
				$("#appendedCategoryLevel").html(response);
			},
			error: function () {
				alert("error");
			}
		});
	});

	//Update Order Status
	$(document).on("change", ".updateOrderStatus", function () {
		var status = $(this).val();
		var order_id = $(this).attr("order_id");
		// alert("ORdderId:"+order_id+"Status"+status);
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: 'post',
			url: '/admin/order/change-status',
			data: { order_id: order_id, status: status },
			success: function (response) {
				// console.log(response);
				Swal.fire({
					position: 'top-end',
					icon: 'success',
					title: response['message'],
					showConfirmButton: false,
					timer: 1500
				})
				location.reload();
			},
			error: function (response) {
				alert("error");
			}
		});
	});

	//Product Attributes Add/Remove Script

	var wrapper = $('.attributeDiv'); //Input field wrapper
	$(".add_button").click(function () {
		var maxField = 10; //Input fields increment limitation
		// var fieldHTML = '<div><select class="col-lg-2" name="attribute_name[]"><option value="">Select</option> @foreach($brands as $brand)  <option value="{{ $brand[\'id\'] }}" @if (!empty($product[\'brand_id\']) && $product[\'brand_id\'] == $brand[\'id\']) selected @endif> {{ $brand[\'name\'] }}</option> @endforeach </select><input class="col-lg-2" type="text" name="attribute_value[]" placeholder="Value" required /><input class="col-lg-2" type="text" name="attribute_price[]" placeholder="Price" required /><input class="col-lg-2" type="text" name="stock[]" placeholder="Stock" required /><input class="col-lg-2" type="text" name="product_sku[]" placeholder="Sku" required /><a href="javascript:void(0);" class="btn remove_button">&nbsp;-</a></div>'; //New input field html 
		var x = 1; //Initial field counter is 1
		var options = "";
		$.ajax({
			url: '/admin/set-attributes',
			type: 'get',
			success: function (response) {
				// console.log(response.attributes);
				response.attributes.forEach(attribute =>
					options += '<option value="' + attribute.name + '"> ' + attribute.name + ' </option>'
				)

				//Check maximum number of input fields
				if (x < maxField) {
					x++; //Increment field counter

					$(wrapper).append('<div class="row"  style="padding: 1rem"><select class="col-lg-2 form-control" name="attribute_name[]"><option value="">Select</option> ' + options + '</select><input class="col-lg-2 form-control" type="text" name="attribute_value[]" placeholder="Value" required /><input class="col-lg-2 form-control" type="number" name="attribute_price[]" min="1" placeholder="Price" required /><input class="col-lg-2 form-control" type="text" name="stock[]" placeholder="Stock" required /><input class="col-lg-2 form-control" type="text" name="product_sku[]" placeholder="Sku" required />&nbsp;<a href="javascript:void(0);" class="btn remove_button">-</a></div>'); //Add field html
				}
			},
			error: function () {
				alert("error");
			}
		});
	});

	//Once remove button is clicked
	$(wrapper).on('click', '.remove_button', function (e) {
		e.preventDefault();
		$(this).parent('div').remove(); //Remove field html
		x--; //Decrement field counter
	});

});