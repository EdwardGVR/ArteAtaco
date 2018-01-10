function editInfoUser() {
	var btnEditar = document.getElementById("btnEditar");
	btnEditar.setAttribute("class", "editar_hidden");

	var btnsOpciones = document.getElementById("btnsOpciones");
	btnsOpciones.setAttribute("class", "opciones");

	var userField = document.getElementById("field_user");
	userField.removeAttribute("readonly");
}

function cancelEditInfoUser() {
	var btnEditar = document.getElementById("btnEditar");
	btnEditar.setAttribute("class", "editar");

	var btnsOpciones = document.getElementById("btnsOpciones");
	btnsOpciones.setAttribute("class", "opciones_hidden");	

	var userField = document.getElementById("field_user");
	userField.setAttribute("readonly", "");
}