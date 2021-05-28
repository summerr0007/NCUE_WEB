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
			window.location.href = "shop_cart.php?add_id=" + item_id + "&add_num=" + item_num + "&add_type=" + add_type;
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
				window.location.assign("shop_cart.php?remove_id=" + item_id);
			})

		}
		else
		{
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
function is_change(item_id, change_num, item_num){
	if(parseInt(item_num)+parseInt(change_num)<=0)
	{
		is_remove(item_id);
	}
	else
	{
		window.location.href = "shop_cart.php?add_id=" + item_id + "&add_num=" + parseInt(change_num)+ "&add_type=3";
	}
}


