$(document).ready(function() {
	// Toast
	$(".btn-toast").click(function() {
		$("#toast-success").hide();
		$("#toast-error").hide();
	});
	
	setTimeout(() => {
		$("#toast-success").hide();
		$("#toast-error").hide();
	}, 2000);

	// Toggle Password
	$('.show-password').click(function() {
		if ($(this).hasClass("fa-eye")) {
			$(this).removeClass('fa-eye');
			$(this).addClass('fa-eye-slash');

			$("#password").attr("type", "text");
		} else {
			$(this).addClass('fa-eye');
			$(this).removeClass('fa-eye-slash');

			$("#password").attr("type", "password");
		}
	});

	// Dashboard Time
	setInterval(showTime, 1000);
	showTime();

	function showTime() {
		let time = new Date();
		let date = time.toUTCString().slice(5, 16);
		let hour = time.getHours();
		let min = time.getMinutes();
		let sec = time.getSeconds();
		am_pm = "AM";

		if (hour >= 12) {
			if (hour > 12) hour -= 12;
			am_pm = "PM";
		} else if (hour == 0) {
			hr = 12;
			am_pm = "AM";
		}

		hour = hour < 10 ? "0" + hour : hour;
		min  = min < 10 ? "0" + min : min;
		sec  = sec < 10 ? "0" + sec : sec;

		let currentTime = date + " " + hour + ":" + min + ":" + sec + " " + am_pm;

		$(".date").html(currentTime);
	}

	// DataTable
	$("#Table").dataTable();

	// New Perdin
	$("#addPerdin").click(function() {
		let modal = $("#addPerdin-modal");

		modal.css("display", "flex");

		closeModal(modal);
	});

	// View Perdin
	$(".perdin-view").click(function() {
		let id = $(this).data("id");
		let token = $("#token").val();
		let modal = $("#viewPerdin-modal");

		$("#approve_id").val(id);
		$("#reject_id").val(id);

		$.ajax({
			url: perdinURL,
			type: "GET",
			data: {
				"_token": token,
				"id": id,
			},
			success: (data) => {
				$("#name").val(data.data['name']);
				$("#city_from").val(data.data['city_from']);
				$("#city_to").val(data.data['city_to']);
				$("#date_from").val(data.data['date_from']);
				$("#date_to").val(data.data['date_to']);
				$("#information").val(data.data['info']);
				$(".data-day").html(data.data['day']);
				$(".data-distance").html(data.data['dist']);

				if(data.data['province'] && data.data['dist'] > 60) {
					$(".perdin-fee").html("Rp200.000,- / Hari");
				} else if(!data.data['province'] && data.data['island']) {
					$(".perdin-fee").html("Rp250.000,- / Hari");
				} else if(!data.data['province'] && !data.data['island'] && !data.data['overseas']) {
					$(".perdin-fee").html("Rp300.000,- / Hari");
				} else if (data.data['overseas']) {
					$(".perdin-fee").html("$50,- / Hari");
				} else {
					$(".perdin-fee").html("Rp0,- / Hari");
				}
				
				if(data.data['dist'] <= 60) {
					$(".perdin-clasification").html("Jarak <= 60");
				} else {
					$(".perdin-clasification").html("Jarak > 60");
				}

				if(data.data['overseas']) {
					let USD = new Intl.NumberFormat('en-US', {
						style: 'currency',
						currency: 'USD',
					});

					var fee = USD.format(data.data['fee']);
				} else {
					let IDR = new Intl.NumberFormat('id-ID', {
						style: 'currency',
						currency: 'IDR',
					});

					var fee = IDR.format(data.data['fee']);
				}

				$(".data-fee").html(fee);

				modal.css("display", "flex");
			}
		});

		closeModal(modal);
	});

	// Calculate Day
	$("input[type='date']").change(function() {
		let from = $("#date_from").val();
		let to = $("#date_to").val();

		let from_date = new Date(from);
		let to_date = new Date(to);

		let diff_in_time = to_date.getTime() - from_date.getTime();
		let diff_in_day	 = diff_in_time / (1000 * 3600 * 24) + 1;

		$(".day").html(diff_in_day);
		$("#total_day").val(diff_in_day);
	});

	// Add User
	$("#addUser").click(function() {
		let modal = $("#addUser-modal");

		$(".form-group.password").show();
		$("#formUser").attr("action", addUserURL);
		$("#addUser-modal .modal-title").html("Tambah Akun Pegawai");
		$("#username").prop("readonly", false);
		$("#userBtn").html("Tambah");

		modal.css("display", "flex");

		closeModal(modal);
	});

	// Edit User
	$(".edit-user").click(function() {
		let username = $(this).data("username");
		let name = $(this).data("name");
		let role = $(this).data("role");
		let status = $(this).data("status");

		let modal = $("#addUser-modal");

		$("#username").val(username);
		$("#username").prop("readonly", true);
		$("#name").val(name);
		$("#role").val(role);
		$("#status").val(status);

		$(".form-group.password").hide();
		$("#formUser").attr("action", updateUserURL);
		$("#addUser-modal .modal-title").html("Update Akun Pegawai");
		$("#userBtn").html("Update");
		
		modal.css("display", "flex");

		closeModal(modal);
	});

	// Delete User
	$(".delete-user").click(function() {
		let id = $(this).data("id");
		let username = $(this).data("username");
		let modal = $("#deleteModal");
		
		$("#delete_id").val(id);
		$("#deleteForm").attr("action", deleteUserURL);
		$(".confirm-text").html("Anda yakin ingin menghapus data pegawai dengan username " + `"${username}"`);

		modal.css("display", "flex");

		closeModal(modal);
	});

	// Add City
	$("#addCity").click(function() {
		let modal = $("#cityModal");

		$("#formCity").attr("action", addCityURL);
		$("#cityModal .modal-title").html("Tambah Kota");
		$("#cityBtn").html("Tambah");

		modal.css("display", "flex");

		closeModal(modal);
	});

	// Edit City
	$(".edit-city").click(function() {
		let modal = $("#cityModal");
		let id	= $(this).data("id");
		let city = $(this).data("city");
		let province = $(this).data("province");
		let island = $(this).data("island");
		let is_overseas = $(this).data("is_overseas");
		let latitude = $(this).data("latitude");
		let longtitude = $(this).data("longtitude");

		$("#id").val(id);
		$("#city").val(city);
		$("#province").val(province);
		$("#island").val(island);
		$("#is_overseas").val(is_overseas);
		$("#latitude").val(latitude);
		$("#longtitude").val(longtitude);

		$("#formCity").attr("action", updateCityURL);
		$("#cityModal .modal-title").html("Edit Kota");
		$("#cityBtn").html("Update");

		modal.css("display", "flex");

		closeModal(modal);
	});

	// Delete City
	$(".delete-city").click(function() {
		let id = $(this).data("id");
		let city = $(this).data("city");
		let modal = $("#deleteModal");
		
		$("#delete_id").val(id);
		$("#deleteForm").attr("action", deleteCityURL);
		$(".confirm-text").html("Anda yakin ingin menghapus data kota " + `"${city}"`);

		modal.css("display", "flex");

		closeModal(modal);
	});

	// Close Delete Modal
	$(".btn-no").click(function() {
		$("#deleteModal").hide();
	});

	// Close Modal Function
	function closeModal(modal) {
		$(".btn-modal").click(function() {
			modal.hide();
		});

		$(window).click(function(event) {
			if(event.target == modal) {
				modal.hide()
			}
		});
	}
});