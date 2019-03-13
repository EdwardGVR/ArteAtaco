function getCookie(cname) {
	var name = cname + "=";
	var decodedCookie = decodeURIComponent(document.cookie);
	var ca = decodedCookie.split(';');
	for(var i = 0; i <ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
}

function editInfoUser() {
	//Botones
	var btnEditar = document.getElementById("btnEditar");
	btnEditar.setAttribute("class", "editar_hidden");

	var btnsOpciones = document.getElementById("btnsOpciones");
	btnsOpciones.setAttribute("class", "opciones");

	//Campos
	var userName = document.getElementById("nombre_user");
	userName.removeAttribute("readonly");
	userName.setAttribute("class", "field");
	userName.removeAttribute("disabled");

	var userLastName = document.getElementById("apellido_user");
	userLastName.removeAttribute("readonly");
	userLastName.setAttribute("class", "field");
	userLastName.removeAttribute("disabled");

	var userEmail = document.getElementById("email_user");
	userEmail.removeAttribute("readonly");
	userEmail.setAttribute("class", "field");
	userEmail.removeAttribute("disabled");

	var userPhone = document.getElementById("telefono_user");
	userPhone.removeAttribute("readonly");
	userPhone.setAttribute("class", "field");
	userPhone.removeAttribute("disabled");

	var userLabelUser = document.getElementById("user_label");
	userLabelUser.setAttribute("class", "user_label");

	var userUser = document.getElementById("user_user");
	userUser.setAttribute("type", "text");
	userUser.setAttribute("class", "field");
	userUser.removeAttribute("readonly");
	userUser.removeAttribute("disabled"); 
}

function cancelEditInfoUser() {
	//Botones
	// var btnEditar = document.getElementById("btnEditar");
	// btnEditar.setAttribute("class", "editar");

	// var btnsOpciones = document.getElementById("btnsOpciones");
	// btnsOpciones.setAttribute("class", "opciones_hidden");	

	// //Campos
	// var userName = document.getElementById("nombre_user");
	// userName.setAttribute("readonly", "");
	// userName.setAttribute("class", "field_user");
	// userName.setAttribute("disabled", "true");

	// var userLastName = document.getElementById("apellido_user");
	// userLastName.setAttribute("readonly", "");
	// userLastName.setAttribute("class", "field_user");
	// userLastName.setAttribute("disabled", "true");

	// var userEmail = document.getElementById("email_user");
	// userEmail.setAttribute("readonly", "");
	// userEmail.setAttribute("class", "field_user");
	// userEmail.setAttribute("disabled", "true");

	// var userPhone = document.getElementById("telefono_user");
	// userPhone.setAttribute("readonly", "");
	// userPhone.setAttribute("class", "field_user");
	// userPhone.setAttribute("disabled", "true");

	location.reload();
}

function addressChange(b) {
	var id = b.parentNode.id;
	console.log(id);

	var direcciones = document.getElementById("cant_direcciones");
	let addAddressBtn = document.getElementById("add_address");
	addAddressBtn.classList.add("hidden");

	switch (id) {
		case "btnEditarDir1":
			// Botones
			b.setAttribute("class", "editar_hidden");
			var opcionesDir = document.getElementById("opcionesDir1");
			opcionesDir.setAttribute("class", "editar");

			// Campos formulario
			var nombreDir = document.getElementById("nombre_dir1");
			nombreDir.removeAttribute("disabled");
			nombreDir.removeAttribute("readonly");

			var linea1Dir = document.getElementById("linea1_dir1");
			linea1Dir.removeAttribute("disabled");
			linea1Dir.removeAttribute("readonly");

			var linea2Dir = document.getElementById("linea2_dir1");
			linea2Dir.removeAttribute("disabled");
			linea2Dir.removeAttribute("readonly");	

			var refDir = document.getElementById("ref_dir1");
			refDir.removeAttribute("disabled");
			refDir.removeAttribute("readonly");			
			break;
		case "btnEditarDir2":
			// Botones
			b.setAttribute("class", "editar_hidden");
			var opcionesDir = document.getElementById("opcionesDir2");
			opcionesDir.setAttribute("class", "editar");

			// Campos formulario
			var nombreDir = document.getElementById("nombre_dir2");
			nombreDir.removeAttribute("disabled");
			nombreDir.removeAttribute("readonly");

			var linea1Dir = document.getElementById("linea1_dir2");
			linea1Dir.removeAttribute("disabled");
			linea1Dir.removeAttribute("readonly");

			var linea2Dir = document.getElementById("linea2_dir2");
			linea2Dir.removeAttribute("disabled");
			linea2Dir.removeAttribute("readonly");

			var refDir = document.getElementById("ref_dir2");
			refDir.removeAttribute("disabled");
			refDir.removeAttribute("readonly");
			break;
		case "btnEditarDir3":
			// Botones
			b.setAttribute("class", "editar_hidden");
			var opcionesDir = document.getElementById("opcionesDir3");
			opcionesDir.setAttribute("class", "editar");

			// Campos formulario
			var nombreDir = document.getElementById("nombre_dir3");
			nombreDir.removeAttribute("disabled");
			nombreDir.removeAttribute("readonly");

			var linea1Dir = document.getElementById("linea1_dir3");
			linea1Dir.removeAttribute("disabled");
			linea1Dir.removeAttribute("readonly");

			var linea2Dir = document.getElementById("linea2_dir3");
			linea2Dir.removeAttribute("disabled");
			linea2Dir.removeAttribute("readonly");

			var refDir = document.getElementById("ref_dir3");
			refDir.removeAttribute("disabled");
			refDir.removeAttribute("readonly");
			break;
		default:
			// statements_def
			break;
	}
}

function newAddress() {
	var btnNewAddress = document.getElementById("add_address");
	btnNewAddress.setAttribute("class", "add_address_hidden");

	var formNewAddress = document.getElementById("new_address");
	formNewAddress.setAttribute("class", "address");

	editarBtns = [...document.getElementsByClassName("editar_boton")];
	editarBtns.forEach(ed => {
		ed.classList.add("hidden");
	});
}

function showChat() {
	var chatBox = document.getElementById("chatBox");
	chatBox.setAttribute("class", "fb_chat chatBox");

	var chatBtn = document.getElementById("chatBtn");
	chatBtn.setAttribute("class", "boton_chat_open");
	chatBtn.setAttribute("onclick", "hideChat()");
}

function hideChat() {
	var chatBox = document.getElementById("chatBox");
	chatBox.setAttribute("class", "fb_chat");

	var chatBtn = document.getElementById("chatBtn");
	chatBtn.setAttribute("onclick", "showChat()");
	chatBtn.setAttribute("class", "boton_chat")
}

if (window.pagId) {
	if (pagId == "carrito") {
		console.log("Pagina de carrito");

		document.cookie = "dirSelected = 0";
		document.cookie = "dirType = 0";
		document.cookie = "pagoSelected = 0";
		
		let showEditCantForm = (e) => {
			console.log(e.target);
			
			let idProd = e.target.attributes.idProd.value,
				currenQuantity = [...document.querySelectorAll(".prod_carrito .info .field .value.cantidad")],
				formEditQuantity = [...document.querySelectorAll(".prod_carrito .info .field form")],
				formQuantitySelect = [...document.querySelectorAll(".prod_carrito .info .field form select")],
				sendQuantity = [...document.querySelectorAll(".prod_carrito .info .field label")],
				cancelEditQuantity = [...document.querySelectorAll(".prod_carrito .info .field div.cancelEQ")],
				precio = [...document.querySelectorAll(".prod_carrito .info_carrito .info .field .precio")],
				subtotalProd = [...document.querySelectorAll(".prod_carrito .info_carrito .info .field .subtotalProd")];
			
			for (let i = 0; i < editCantCarr.length; i++) {
				editCantCarr[i].setAttribute('class', 'hidden');
				if (editCantCarr[i].getAttribute('idProd') == idProd) {
					currenQuantity[i].setAttribute('class', 'hidden');
					formEditQuantity[i].setAttribute('class', 'cantidad');
					cancelEditQuantity[i].setAttribute('class', 'cancelEditQuantity');
					
					cancelEditQuantity[i].addEventListener('click', () => {
						location.reload();
					});
		
					console.log(precio[i].innerHTML.substring(1));
					
		
					formQuantitySelect[i].addEventListener('change', () => {
						sendQuantity[i].setAttribute('class', 'iconUpdtQnt');
						subtotalProd[i].innerHTML = '$' + formQuantitySelect[i].value * precio[i].innerHTML.substring(1);
					});
				}
			}
		};
		
		let editCantCarr = [...document.querySelectorAll(".editarCant")];
		if (editCantCarr != null) {
			for (let i = 0; i < editCantCarr.length; i++) {
				editCantCarr[i].addEventListener('click', showEditCantForm);
			}
		}

	} else if (pagId == "checkout") {
		console.log("Pagina de caja");

		let showNewAddressForm = document.getElementById("showNewAddressForm");
		if (showNewAddressForm != null) {
			showNewAddressForm.addEventListener('click', () => {
				let newAddressForm = document.getElementById("newAddressForm");
				newAddressForm.setAttribute('class', 'form_new_address');
			});
		}
		
		let cancelNewAddresOnCheckout = document.getElementById("cancelNewAddressChkt");
		if (cancelNewAddresOnCheckout != null) {
			cancelNewAddresOnCheckout.addEventListener('click', () =>{
				location.reload(true);
			})
		}
		
		let bodyCheckout = document.querySelector("body.checkout");
		if (bodyCheckout != null) {	
			let infoCheckout = document.querySelector(".contenedor_checkout .info_checkout");
			window.addEventListener("resize", () => {
				// console.log(infoCheckout.clientWidth);
				let carritoCheckout = document.getElementById("carritoCheckout");
				if (infoCheckout.clientWidth == 440) {
					carritoCheckout.setAttribute("class", "carrito_checkout_noFixed");
				} else {
					carritoCheckout.setAttribute("class", "carrito_checkout");
				}
			});
			
		}

		let selectAddressBtns = [...document.querySelectorAll(".selectDir")];
		if (selectAddressBtns != null) {
			for (let i = 0; i < selectAddressBtns.length; i++) {
				selectAddressBtns[i].addEventListener("click", (e) => {
					let idAddress = e.target.attributes.idAddress.value,
						typeAddress = e.target.attributes.addresstype.value;

					document.cookie = "dirSelected =" + idAddress;
					document.cookie = "dirType =" + typeAddress;
					
					location.reload();
				});
			}
		}

		if (getCookie("dirSelected") != 0) {
			let dirActive = document.getElementById("dirUser" + getCookie("dirSelected")),
				selectDirBtn = document.querySelector("#dirUser" + getCookie("dirSelected") + " .options a.selectDir"),
				notUseBtn = document.querySelector("#dirUser" + getCookie("dirSelected") + " .options a.hidden"),
				checkOnDir = document.querySelector("#dirUser" + getCookie("dirSelected") + " .hidden.checkOnDir");

			dirActive.setAttribute("class", "shipping_address_active");
			selectDirBtn.setAttribute("class", "hidden");
			notUseBtn.setAttribute("class", "button selectDir cancel");
			checkOnDir.setAttribute("class", 'selected-check');

			let cancelDir = document.getElementById("cancelDirUser" + getCookie("dirSelected"));
			if (cancelDir != null) {
				cancelDir.addEventListener("click", ()=>{
					document.cookie = "dirSelected =; expires=Thu, 01 Jan 1970 00:00:00 UTC";
					document.cookie = "dirType =; expires=Thu, 01 Jan 1970 00:00:00 UTC";
					location.reload();
				});
			}

			let anularDir = document.getElementById("anularDirUser" + getCookie("dirSelected"));
			if (anularDir != null) {
				anularDir.addEventListener("click", () => {
					document.cookie = "dirSelected =; expires=Thu, 01 Jan 1970 00:00:00 UTC";
					document.cookie = "dirType =; expires=Thu, 01 Jan 1970 00:00:00 UTC";
					location.reload();
				});
			}
		}

		let selectPagoRadio = [...document.querySelectorAll(".radioPago")];
		if (selectPagoRadio != null) {
			for (let i = 0; i < selectPagoRadio.length; i++) {
				selectPagoRadio[i].addEventListener("click", (e) => {
					let idPago = e.target.attributes.idPago.value;
					// console.log(idPago);

					document.cookie = "pagoSelected = " + idPago;
					location.reload();
				});
			}
		}
		
		if (getCookie("pagoSelected") != 0) {
			let pagoActive = document.getElementById("payOption" + getCookie("pagoSelected")),
				inputRadioPago = document.getElementById("metodoPago" + getCookie("pagoSelected")),
				anularPagoSel = document.getElementById("anularPagoUser" + getCookie("pagoSelected"));

			if (pagoActive != null) {
				pagoActive.setAttribute("class", "pay_option_active");
				inputRadioPago.setAttribute("disabled", "");
				inputRadioPago.setAttribute("checked", "");
				
				anularPagoSel.addEventListener("click", () => {
					document.cookie = "pagoSelected =; expires=Thu, 01 Jan 1970 00:00:00 UTC";
					location.reload();
				});
			}


		}
		// console.log(getCookie("dirSelected"));
		
		let checkoutBtn = document.getElementById("checkoutBtn");
		if (checkoutBtn != null) {
			checkoutBtn.addEventListener("click", () => {
				document.cookie = "checkoutCheckpoint =" + true;
			});
		}
	} else if (pagId == "lamps") {
		console.info("Pagina de lamparas");

		let customLampsBtn = document.getElementById("customLampsBtn");
		customLampsBtn.classList.remove("hidden");
	} else if (pagId == "lampsDetails") {
		console.info("Pagina de detalles de lamparas");

		let customLampsBtn = document.getElementById("customText");
		customLampsBtn.classList.remove("hidden");

		let itemsQty = document.getElementById("itemsQty"),
			customTextBtn = document.getElementById("customTextBtn"),
			cancelTextBtn = document.getElementById("cancelTextBtn"),
			firstTextGroup = document.getElementById("textGroup1"),
			allTexts = [...document.getElementsByClassName("textsGroup")],
			titleBtns = [...document.getElementsByClassName("lampTitle")],
			textConts = [...document.getElementsByClassName("textConts")];

		customTextBtn.addEventListener("click", () => {
			firstTextGroup.classList.remove("hidden");
			cancelTextBtn.classList.remove("hidden");
			textConts[0].classList.remove("hidden");


			newQty = itemsQty.value;

			if (cancelTextBtn.classList[1] != "hidden") {
				for (let i = 0; i < newQty; i++) {
					allTexts[i].classList.remove("hidden");
				}
	
				for (let j = newQty; j < 10; j++) {
					allTexts[j].classList.add("hidden");
				}
			}
		});

		for (i = 0; i < titleBtns.length; i++) {
			titleBtns[i].addEventListener("click", (e) => {
				idText = e.target.id;
				idText = idText.substring(idText.length -1);
				showTextGroup = document.getElementById("textsLamp" + idText);
				showTextGroup.classList.remove("hidden");
			});
		}

		cancelTextBtn.addEventListener("click", () => {
			cancelTextBtn.classList.add("hidden");

			for (i = 0; i < allTexts.length; i++) {
				allTexts[i].classList.add("hidden");
				textConts[i].classList.add("hidden");
			}
		});

		itemsQty.addEventListener("change", () => {
			newQty = itemsQty.value;
			if (newQty > 10) {
				itemsQty.value = 10;
				newQty = 10;
			}

			if (cancelTextBtn.classList[1] != "hidden") {
				for (let i = 0; i < newQty; i++) {
					allTexts[i].classList.remove("hidden");
				}
	
				for (let j = newQty; j < 10; j++) {
					allTexts[j].classList.add("hidden");
				}
			}
		});
	}
}