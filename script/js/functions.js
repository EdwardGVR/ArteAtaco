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
		// case btnEditarDir4:
		// 	// Botones
		// 	b.setAttribute("class", "editar_hidden");
		// 	var opcionesDir = document.getElementById("opcionesDir4");
		// 	opcionesDir.setAttribute("class", "editar");

		// 	// Campos formulario
		// 	var nombreDir = document.getElementById("nombre_dir4");
		// 	nombreDir.removeAttribute("disabled");
		// 	nombreDir.removeAttribute("readonly");

		// 	var linea1Dir = document.getElementById("linea1_dir4");
		// 	linea1Dir.removeAttribute("disabled");
		// 	linea1Dir.removeAttribute("readonly");

		// 	var linea2Dir = document.getElementById("linea2_dir4");
		// 	linea2Dir.removeAttribute("disabled");
		// 	linea2Dir.removeAttribute("readonly");

		// 	var refDir = document.getElementById("ref_dir4");
		// 	refDir.removeAttribute("disabled");
		// 	refDir.removeAttribute("readonly");
		// 	break;
		// case btnEditarDir5:
		// 	// Botones
		// 	b.setAttribute("class", "editar_hidden");
		// 	var opcionesDir = document.getElementById("opcionesDir5");
		// 	opcionesDir.setAttribute("class", "editar");

		// 	// Campos formulario
		// 	var nombreDir = document.getElementById("nombre_dir5");
		// 	nombreDir.removeAttribute("disabled");
		// 	nombreDir.removeAttribute("readonly");

		// 	var linea1Dir = document.getElementById("linea1_dir5");
		// 	linea1Dir.removeAttribute("disabled");
		// 	linea1Dir.removeAttribute("readonly");

		// 	var linea2Dir = document.getElementById("linea2_dir5");
		// 	linea2Dir.removeAttribute("disabled");
		// 	linea2Dir.removeAttribute("readonly");

		// 	var refDir = document.getElementById("ref_dir5");
		// 	refDir.removeAttribute("disabled");
		// 	refDir.removeAttribute("readonly");
		// 	break;
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

let showEditCantForm = (e) => {
	console.log(e.target);
	
	let idProd = e.target.attributes.idProd.value,
		currenQuantity = [...document.querySelectorAll(".prod_carrito .info .field .value.cantidad")],
		formEditQuantity = [...document.querySelectorAll(".prod_carrito .info .field form")],
		formQuantitySelect = [...document.querySelectorAll(".prod_carrito .info .field form select")],
		sendQuantity = [...document.querySelectorAll(".prod_carrito .info .field label")],
		cancelEditQuantity = [...document.querySelectorAll(".prod_carrito .info .field div.cancelEQ")];
	
	for (let i = 0; i < editCantCarr.length; i++) {
		editCantCarr[i].setAttribute('class', 'hidden');
		if (editCantCarr[i].getAttribute('idProd') == idProd) {
			currenQuantity[i].setAttribute('class', 'hidden');
			formEditQuantity[i].setAttribute('class', 'cantidad');
			cancelEditQuantity[i].setAttribute('class', 'cancelEditQuantity');
			
			cancelEditQuantity[i].addEventListener('click', () => {
				location.reload();
			});

			formQuantitySelect[i].addEventListener('change', () => {
				sendQuantity[i].setAttribute('class', 'iconUpdtQnt');
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