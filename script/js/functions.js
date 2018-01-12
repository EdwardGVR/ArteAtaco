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
}

function cancelEditInfoUser() {
	//Botones
	var btnEditar = document.getElementById("btnEditar");
	btnEditar.setAttribute("class", "editar");

	var btnsOpciones = document.getElementById("btnsOpciones");
	btnsOpciones.setAttribute("class", "opciones_hidden");	

	//Campos
	var userName = document.getElementById("nombre_user");
	userName.setAttribute("readonly", "");
	userName.setAttribute("class", "field_user");
	userName.setAttribute("disabled", "true");

	var userLastName = document.getElementById("apellido_user");
	userLastName.setAttribute("readonly", "");
	userLastName.setAttribute("class", "field_user");
	userLastName.setAttribute("disabled", "true");

	var userEmail = document.getElementById("email_user");
	userEmail.setAttribute("readonly", "");
	userEmail.setAttribute("class", "field_user");
	userEmail.setAttribute("disabled", "true");

	var userPhone = document.getElementById("telefono_user");
	userPhone.setAttribute("readonly", "");
	userPhone.setAttribute("class", "field_user");
	userPhone.setAttribute("disabled", "true");

	location.reload();
}

function addressChange(b) {
	// console.log(b.parentNode.id);
	var id = b.parentNode.id;
	console.log(id);

	// var btnEditAddress = document.getElementById("btnEditarDir");
	// btnEditAddress.setAttribute("class", "editar_hidden");

	// var opcionesAddress = document.getElementById("opcionesDir");
	// opcionesAddress.setAttribute("class", "editar");

	var direcciones = document.getElementById("cant_direcciones");

	// for (var i = 1; i < direcciones.getAttribute("value"); i++) {
	// 	Things[i]
	// }

	switch (id) {
		case "btnEditarDir1":
			b.setAttribute("class", "editar_hidden");
			var opcionesDir = document.getElementById("opcionesDir1");
			opcionesDir.setAttribute("class", "editar");
			break;
		case "btnEditarDir2":
			b.setAttribute("class", "editar_hidden");
			var opcionesDir = document.getElementById("opcionesDir2");
			opcionesDir.setAttribute("class", "editar");
			break;
		case "btnEditarDir3":
			b.setAttribute("class", "editar_hidden");
			var opcionesDir = document.getElementById("opcionesDir3");
			opcionesDir.setAttribute("class", "editar");
			break;
		case btnEditarDir4:
			b.setAttribute("class", "editar_hidden");
			var opcionesDir = document.getElementById("opcionesDir4");
			opcionesDir.setAttribute("class", "editar");
			break;
		case btnEditarDir5:
			b.setAttribute("class", "editar_hidden");
			var opcionesDir = document.getElementById("opcionesDir5");
			opcionesDir.setAttribute("class", "editar");
			break;
		default:
			// statements_def
			break;
	}
}