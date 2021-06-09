function redir(target, key, value) {
	if (key != "")
		window.location.assign(target + ".php?" + key + "=" + value);
	else
		window.location.assign(target + ".php");
}
function is_add(item_id, item_num, w_log, add_type) {
	if (w_log == 1 && add_type == 0) {
		// Swal.fire({
		// 	title: 'Are you sure?',
		// 	text: "You won't be able to revert this!",
		// 	icon: 'warning',
		// 	showCancelButton: true,
		// 	confirmButtonColor: '#3085d6',
		// 	cancelButtonColor: '#d33',
		// 	confirmButtonText: 'Yes, delete it!'
		//   }).then((result) => {
		// 	if (result.isConfirmed) {
		// 		Swal.fire({
		// 			icon: 'success',
		// 			title: 'Your work has been saved',
		// 			showConfirmButton: false,
		// 			timer: 1500
		// 		}).then(() => {
		// 				window.location.href = "shop_cart.php?add_id=" + item_id + "&add_num="+item_num;
		// 		  })

		// 	}
		// })
		Swal.fire({
			icon: 'success',
			title: '加入成功!',
			showConfirmButton: false,
			timer: 800
		}).then(() => {
			$.ajax({
				url: "shop_cart_ajax.php?add_id=" + item_id + "&add_num=" + item_num + "&add_type=" + add_type,
				async: false,
				type: 'GET',
				success: function (data) {
					$("#intro").html(data);
				},
				error: function (xhr, ajaxOptions, thrownError) { }
			});
			$.ajax({
				url: "shop_cart_ajax.php?cart_count=1",
				async: true,
				type: 'GET',
				success: function (data) {
					$("#intro_2").html(data);
				},
				error: function (xhr, ajaxOptions, thrownError) { }
			});
			// var xhttp2 = new XMLHttpRequest();
			// xhttp2.onreadystatechange = function() {
			// 	if (this.readyState == 4 && this.status == 200) {
			// 			document.getElementById("intro_2").innerHTML = this.responseText;
			// 	}
			// };
			// xhttp2.open("GET", "shop_cart_ajax.php?cart_count=1", true);
			// xhttp2.send();

			// window.location.href = "shop_cart.php?add_id=" + item_id + "&add_num=" + item_num + "&add_type=" + add_type;
		})
	}
	else if (w_log == 1 && add_type == 1) {
		window.location.href = "shop_cart.php?add_id=" + item_id + "&add_num=" + item_num + "&add_type=" + add_type;
	}
	else {
		Swal.fire({
			title: '請先登入會員!',
			icon: 'warning',
			showClass: {
				popup: 'animate__animated animate__bounceIn'
			},
			// hideClass: {
			//   popup: 'animate__animated animate__fadeOutUp'
			// }
		}).then(() => {
			window.location.href = "shop_cart.php";
		})
	}
}
function is_remove(item_id) {
	// if (confirm("是否要從購物車中移除?")) {
	// 	alert("移除商品成功!");
	// 	window.location.assign("shop_cart.php?remove_id=" + item_id);
	// }
	Swal.fire({
		title: '是否要從購物車中移除?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: '確定',
		cancelButtonText: '取消'
	}).then((result) => {
		if (result.isConfirmed) {
			Swal.fire({
				icon: 'success',
				title: '移除成功!',
				showConfirmButton: false,
				timer: 800
			}).then(() => {
				$.ajax({
					url: "shop_cart_ajax.php?remove_id=" + item_id,
					async: false,
					type: 'GET',
					success: function (data) {
						$("#intro").html(data);
					},
					error: function (xhr, ajaxOptions, thrownError) { }
				});
				$.ajax({
					url: "shop_cart_ajax.php?cart_count=1",
					async: true,
					type: 'GET',
					success: function (data) {
						$("#intro_2").html(data);
					},
					error: function (xhr, ajaxOptions, thrownError) { }
				});
				// var xhttp2 = new XMLHttpRequest();
				// xhttp2.onreadystatechange = function() {
				// 	if (this.readyState == 4 && this.status == 200) {
				// 			document.getElementById("intro_2").innerHTML = this.responseText;
				// 	}
				// };
				// xhttp2.open("GET", "shop_cart_ajax.php?cart_count=1", true);
				// xhttp2.send();

				// window.location.assign("shop_cart.php?remove_id=" + item_id);
			})

		}
		else {
			window.location.assign("shop_cart.php");
		}
	})
}
function checkout(time, bill) {
	// if (confirm("確定要送出訂單?")) {
	// 	alert("送出訂單成功!");
	// 	window.location.assign("members_area.php?bill="+bill+"&time="+time);
	// }
	Swal.fire({
		title: '確定要送出訂單?',
		icon: 'warning',
		showCancelButton: true,

		cancelButtonColor: '#d33',
		confirmButtonColor: '#3085d6',
		confirmButtonText: '好挖!',
		cancelButtonText: '再逛逛'
	}).then((result) => {
		if (result.isConfirmed) {
			Swal.fire({
				icon: 'success',
				title: '送出訂單成功',
				showConfirmButton: false,
				timer: 800
			}).then(() => {
				window.location.assign("members_area.php?bill=" + bill + "&time=" + time);
			})

		}
	})
}
function area_remove(item_id, bill) {
	// if (confirm("是否要移除訂單?")) {
	// 	alert("移除訂單成功!");
	// 	window.location.assign("members_area.php?remove_id=" + item_id + "&seq=" + bill);
	// }
	Swal.fire({
		title: '確定要刪除訂單?',
		imageUrl: './images/deleteorder.jpg',
		imageWidth: 400,
		imageHeight: 200,
		imageAlt: '沒圖喔QQ',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: '我叫你刪!',
		cancelButtonText: '算了'
	}).then((result) => {
		if (result.isConfirmed) {
			Swal.fire({
				icon: 'success',
				title: '那你要慢慢等管理員回復ㄟ割',
				showCancelButton: false,
			}).then(() => {
				window.location.assign("members_area.php?remove_id=" + item_id + "&seq=" + bill);
			})

		}
	})
}
function arealist_remove(item_id, bill) {
	// if (confirm("是否要移除訂單?")) {
	// 	alert("移除訂單成功!");
	// 	window.location.assign("orderlist.php?remove_id=" + item_id + "&seq=" + bill);
	// }
	Swal.fire({
		title: '確定要刪除訂單?',
		imageUrl: './images/deleteorder.jpg',
		imageWidth: 400,
		imageHeight: 200,
		imageAlt: '沒圖喔QQ',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: '我叫你刪!',
		cancelButtonText: '算了'
	}).then((result) => {
		if (result.isConfirmed) {
			Swal.fire({
				icon: 'success',
				title: '那你要慢慢等管理員回復ㄟ割',
				showCancelButton: false,
			}).then(() => {
				window.location.assign("orderlist.php?remove_id=" + item_id + "&seq=" + bill);
			})

		}
	})
}
function is_change(item_id, change_num, item_num) {
	if (parseInt(item_num) + parseInt(change_num) <= 0) {
		is_remove(item_id);
	}
	else {

		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("intro").innerHTML = this.responseText;
			}
		};
		xhttp.open("GET", "shop_cart_ajax.php?add_id=" + item_id + "&add_num=" + parseInt(change_num) + "&add_type=3", true);
		xhttp.send();

		// window.location.href = "shop_cart.php?add_id=" + item_id + "&add_num=" + parseInt(change_num)+ "&add_type=3";
	}
}
function cart_1(item_id, w_log) {

	var offset = $('#intro_22').offset();//目的地(navbar的購物車)

	if (w_log == 1) {
		var w_left = $(window).scrollLeft();
		var w_top = $(window).scrollTop();
		var st = $('#' + item_id).offset();//起始點(商品的購物車圖示)

		var flyer = $('<img class="flyer" style="height:50px;" src="./images/p_' + item_id + '.jpg">');//用圖源建一個新物件
		// alert(item_id+"success1"+w_log);
		$(flyer).load(function () {//該物件加載(圖片)成功才開始飛

			flyer.fly({
				start: {//開始飛
					left: st.left - w_left,
					top: st.top - w_top
				},
				end: {//結束
					left: offset.left + 50 - w_left,
					top: offset.top - w_top,
					width: 0,
					height: 0
				},
				speed: 2, //越大越快
				onEnd: function () {//消除
					setTimeout(function () {
					}, 200);

					$.ajax({
						url: "shop_cart_ajax.php?add_id=" + item_id + "&add_num=1&add_type=0&cart_icon=1",
						async: false,
						type: 'GET',
						// dataType: "json",
						success: function (data) {
							$("#" + item_id).html(data);
						},
						error: function (xhr, ajaxOptions, thrownError) { }
					});
					$.ajax({
						url: "shop_cart_ajax.php?cart_count=1",
						async: true,
						type: 'GET',
						// dataType: "json",
						success: function (data) {
							$("#intro_2").html(data);
						},
						error: function (xhr, ajaxOptions, thrownError) { }
					});
					// var xhttp2 = new XMLHttpRequest();
					// xhttp2.onreadystatechange = function() {
					// 	if (this.readyState == 4 && this.status == 200) {
					// 			document.getElementById("intro_2").innerHTML = this.responseText;
					// 	}
					// };
					// xhttp2.open("GET", "shop_cart_ajax.php?cart_count=1", true);
					// xhttp2.send();
				}
			});
		});
	}
}
function nav_slide(log) {
	if (log == 1)
		if (!$("nav").is(':visible'))
			$("nav").stop().show();
}
function is_check(a) {
	$.ajax({
		url: "shop_cart_ajax.php",
		type: 'POST',
		// dataType: "json",
		data: {
			check_id: a
		},
		success: function (data) {
			$("#intro").html(data);
		},
		error: function (xhr, ajaxOptions, thrownError) { }
	});
}
function review() {
	// alert(document.getElementById("item_id").innerHTML)	;
	// alert(document.getElementById("item_order").innerHTML)	;
	var x = document.getElementsByName("r");
	var y = document.getElementById("message-text");
	var star = "";
	for (var i = 0; i < x.length; i++) {
		if (x[i].type == "radio") {
			if (x[i].checked) {
				star = x[i].value;
			}
		}
	}
	// alert(Str);
	$.ajax({
		url: "shop_cart_ajax.php",
		type: 'POST',
		data: {
			item_id: document.getElementById("item_id").innerHTML,
			item_order: document.getElementById("item_order").innerHTML,
			item_text: y.value.replace('\n', '<br>'),
			item_star: star
		},
		success: function () {
			Swal.fire({
				icon: 'success',
				title: '已收到您的回覆，謝謝!',
				showConfirmButton: false,
				timer: 800
			}).then(() => {
				window.location.assign("members_area.php");
			})
		},
		error: function (xhr, ajaxOptions, thrownError) { }
	});

	// alert(y.value);
}
function change_text(seq, name, id, order) {
	var x = document.getElementById("exampleModalLabel");
	var y = document.getElementById("item_name");
	x.innerHTML = '<div class="container"><div class="row">訂單編號:' + seq + '</div></div>';
	y.innerHTML = '<h4>' + name + '</h4>';
	document.getElementById("item_id").innerHTML = id;
	document.getElementById("item_order").innerHTML = order;
	// alert(document.getElementById("item_id").innerHTML)	;
	// alert(document.getElementById("item_order").innerHTML)	;
}


