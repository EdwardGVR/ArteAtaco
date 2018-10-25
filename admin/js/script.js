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

if (document.title == 'Detalles de pedido') {

    console.log("Detalles de pedido");

    let updateOrderStatusBtns = [...document.getElementsByClassName('updOrderStat')];
    for (let i = 0; i < updateOrderStatusBtns.length; i++) {
        // Agregar evento para mostrar opciones
        updateOrderStatusBtns[i].addEventListener('click', () => {
            let updateOrderStatusForms = [...document.getElementsByClassName('orderStatusForm')],
                selectsOrderStatus = [...document.getElementsByClassName('sel_status')];
            updateOrderStatusBtns[i].setAttribute('class', 'cancelUpdateOrderStatus'); 
            updateOrderStatusBtns[i].innerText = "Cancelar";
            selectsOrderStatus[i].setAttribute('class', 'sel_stat');
            let cancelarOrderStatus = [...document.getElementsByClassName('cancelUpdateOrderStatus')];
            // Agregar evento para cancelar cambio de estado
            for (let j = 0; j < cancelarOrderStatus.length; j++) {            
                cancelarOrderStatus[j].addEventListener('click', () => {
                    cancelarOrderStatus[j].style.marginRight = '-100px';
                    selectsOrderStatus[i].setAttribute('class', 'sel_stat_hidden');
                    setTimeout(() => {
                        location.reload();
                    }, 200);
                });            
            }
            // Agregar evento para mostrar boton de aceptar (al cambiar el valor)
            for (let k = 0; k < selectsOrderStatus.length; k++) {
                selectsOrderStatus[k].addEventListener('change', () => {
                    let submitsOrderStatus = [...document.getElementsByClassName('submit_status')];
                    selectsOrderStatus[k].style.marginRight = '20px';
                    submitsOrderStatus[k].style.visibility = 'visible';
                });
            }
        });
    
    }

} else if (document.title == 'Detalles producto') {
    console.info("Detalles producto");

    let deleteProducts = [...document.getElementsByClassName('delProd')],
        editProducts = [...document.getElementsByClassName('editProd')];
    
    for (let i = 0; i < deleteProducts.length; i++) {
        deleteProducts[i].addEventListener('click', function confirmProdDel (e) {
            if (!confirm('Se eliminará el producto, incluyendo imagenes.\n\nSi solamente desea que no se muestre al cliente.\n\nConsidere mejor desactivar la disponibilidad.\n\n\nPulse Aceptar para continuar con la eliminación.\n\n\n')) {
                e.preventDefault();
            }
        });
    }
    
    for (let j = 0; j < editProducts.length; j++) {
        editProducts[j].addEventListener('click', (e) => {

            if (e.target.getAttribute('class').substring(0,2) == 'fa') {
                var idProd = e.target.getAttribute('class').substring(11,12);
            } else if (e.target.getAttribute('class').substring(0,2) == 'ic') {
                var idProd = e.target.getAttribute('class').substring(14,15);
            }

            let fields = [...document.querySelectorAll('.producto_list .info .valueProd' + idProd)],
                options = [...document.querySelectorAll('.producto_list .options .opt')],
                editOptions = [...document.querySelectorAll('.producto_list .options .editProd' + idProd)],
                cancelEdit = [...document.querySelectorAll('.producto_list .options .cancelEdit')];
    
            for (let f = 0; f < fields.length; f++) {
                fields[f].setAttribute('class', fields[f].getAttribute('class') + ' active');
                fields[f].removeAttribute('disabled');

                if (fields[f].getAttribute('id') == 'precioProd') {
                    fields[f].setAttribute('type', 'number');
                }
            }
            
            for (let o = 0; o < options.length; o++) {
                options[o].setAttribute('class', 'hidden');
            }
    
            for (let hiddenO = 0; hiddenO < editOptions.length; hiddenO++) {
                editOptions[hiddenO].setAttribute('class', 'opt');
            }
    
            for (let c = 0; c < cancelEdit.length; c++) {
                cancelEdit[c].addEventListener('click', () => {
                    for (let f = 0; f < fields.length; f++) {
                        fields[f].setAttribute('disabled', 'true');
                    }       
                    location.reload(true);
                });
            }
        });
    }

    // Confirmar activacion
    let confirmToggle = document.getElementById("confirmToggle"),
        modal = document.getElementById("modal"),
        toggleMsg = document.getElementById("toggleMsg"),
        closeModal = document.getElementById("closeModal");
    
    if (confirmToggle != undefined) {
        confirmToggle.addEventListener("click", () => {
            // Abrir modal
            modal.classList.add("open");
            toggleMsg.classList.remove("hidden");

            // Cerrar modal
            closeModal.addEventListener("click", () => {
                modal.classList.remove("open");
                toggleMsg.classList.add("hidden");
                chooseCatMsg.classList.add("hidden");
            });
            window.addEventListener("keyup", function (e) {
                if (e.value = 27) {
                    modal.classList.remove("open");
                    toggleMsg.classList.add("hidden");
                    chooseCatMsg.classList.add("hidden");
                }
            });

            let activeCat = document.getElementById("activeCat"),
                chooseCat = document.getElementById("chooseCat"),
                othersCat = document.getElementById("othersCat"),
                toggleForm = document.getElementById("toggleForm"),
                actionForm = document.getElementById("actionForm");
            
            activeCat.addEventListener("click", () => {
                actionForm.setAttribute("value", "activeCat");
                toggleForm.submit();
            });

            chooseCat.addEventListener("click", () => {
                
                let chooseCatMsg = document.getElementById("chooseCatMsg"),
                    cancelChoose = document.getElementById("cancelChoose"),
                    newCatSelect = document.getElementById("newCatSelect"),
                    newCat = document.getElementById("newCat"),
                    saveNewCatBtn = document.getElementById("saveNewCatBtn");
                
                toggleMsg.classList.add("hidden");
                chooseCatMsg.classList.remove("hidden");

                actionForm.setAttribute("value", "chooseCat");
                
                cancelChoose.addEventListener("click", () => {
                    modal.classList.remove("open");
                    toggleMsg.classList.add("hidden");
                    chooseCatMsg.classList.add("hidden");
                });

                newCatSelect.addEventListener("change", () => {
                    newCat.setAttribute("value", newCatSelect.value);
                    saveNewCatBtn.classList.add("active");
                });

                saveNewCatBtn.addEventListener("click", () => {
                    toggleForm.submit();
                });

            });

            othersCat.addEventListener("click", () => {
                actionForm.setAttribute("value", "othersCat");
                toggleForm.submit();
            });
        });
    }
    
} else if (document.title == 'Productos') {
    console.log("Productos");
    
    let canelNewProduct = document.getElementById('cancelNewProd');
    canelNewProduct.addEventListener('click', () => {
        location.reload(true);
    });

    let addNewProductBtn = document.getElementById('addProductBtn');
    addNewProductBtn.addEventListener('click', () => {
        addNewProductBtn.setAttribute('class', 'add_product hidden');

        // setTimeout(() => {
            let newProducForm = document.getElementById('newProductForm');
            newProducForm.setAttribute('class', 'newProductForm');
        // }, 5000);
    });
    
} else if (document.title == 'Puntos de entrega') {
    console.log("Puntos de entrega");

    let btnShowForm = document.getElementById('btnShowForm');

    btnShowForm.addEventListener("click", () => {
        let formNewPoint = document.getElementById('formNewPoint'),
            puntoTitle = document.getElementById("puntosTitle"),
            btnsActionForm = [...document.querySelectorAll(".contenedorNoPuntos .punto .btnAdd.noShow")],
            btnCancelForm = document.getElementById("cancelForm"),
            radioSiGratis = document.getElementById("siGratis"),
            radioNoGratis = document.getElementById("noGratis"),
            inputCostoEntrega = document.getElementById("costoEntrega");

        formNewPoint.setAttribute("class", "addPoint");
        btnShowForm.setAttribute("class", "hidden");
        puntoTitle.innerText = "Datos del punto.";
        puntoTitle.setAttribute("class", "text active");

        for (let i = 0; i < btnsActionForm.length; i++) {
            btnsActionForm[i].classList.remove("noShow");
        }

        btnCancelForm.addEventListener("click", () =>{
            location.replace("puntosEntrega.php");
        });

        radioSiGratis.addEventListener("click", () =>{
            inputCostoEntrega.setAttribute("type", "hidden");
        });

        radioNoGratis.addEventListener("click", () =>{
            inputCostoEntrega.setAttribute("type", "number");
        });
    });
} else if (document.title == "Detalles punto de entrega") {
    console.info("Pagina detalles de punto de entrega");

    let deleteBtn = document.getElementById("deleteBtn");

    deleteBtn.addEventListener("click", function confirmDel (e) {
        if (!confirm('Se eliminará el punto de entrega')) {
            e.preventDefault();
        }
    });
    
} else if (document.title == "Detalles metodo") {
    console.info("Pagina detalles de metodo de pago");
    
    editBtns = [...document.querySelectorAll(".edit")],
    cancelBtns = [...document.querySelectorAll(".cancel")],
    deleteBtn = document.getElementById("deleteMethod");

    for (let i =0; i < editBtns.length; i++) {
        editBtns[i].addEventListener("click", () => {
             for (let j = 0; j < editBtns.length; j++) {
                editBtns[j].classList.add("hidden");
                // cancelBtns[j].classList.remove("hidden");
             }

            if (editBtns[i].getAttribute("id") == "editIcon") {
                console.log(editBtns[i].getAttribute("id"));
    
                iconForm = document.getElementById("iconForm"),
                arrowIcon = document.getElementById("arrowIcon"),
                newIcon = document.getElementById("newIcon"),
                newIconPreview = document.getElementById("newIconPreview"),
                iconCode = document.getElementById("iconCode"),
                setNewIcon = document.getElementById("setNewIcon"),
                currentIcon = document.getElementById("currentIcon"),
                eqIcons = document.getElementById("eqIcons");

                currIconClass = currentIcon.children[0].attributes.class.value;
                console.log(currIconClass);
                

                arrowIcon.classList.remove("hidden");
                newIcon.classList.remove("hidden");
                iconForm.classList.remove("hidden");
                
                iconCode.addEventListener("keyup", () => {
                    if (iconCode.value.substring(0, 8) == '<i class') {
                        codeArr = iconCode.value.split('<');
                        icon = iconCode.value.substring(iconCode.value.lastIndexOf(">") +1, 0);

                        if (codeArr.length == 3) {
                            newIconPreview.innerHTML = icon;
                            iconCode.value = icon;
                        }
                    }
                    if (iconCode.value != "") {
                        if (newIconPreview.children[0].attributes.class.value != "fas fa-question-circle") {
                            if (newIconPreview.children[0].attributes.class.value != currIconClass) {
                                setNewIcon.classList.remove("hidden");
                                setNewIcon.removeAttribute("disabled");
                                eqIcons.classList.add("hidden");
                            } else {
                                setNewIcon.classList.add("hidden");
                                eqIcons.classList.remove("hidden");
                            }
                        } else {
                            setNewIcon.classList.add("hidden");
                        }
                    } else {
                        setNewIcon.classList.add("hidden");
                    }
                });
            } else if (editBtns[i].getAttribute("id") == "editName") {
                let newNameInput = document.getElementById("newName"),
                    saveNewName = document.getElementById("saveNewName"),
                    sameName = document.getElementById("errMsg"),
                    cancelName = document.getElementById("cancelName");

                newNameInput.removeAttribute("disabled");
                saveNewName.removeAttribute("disabled");
                cancelName.classList.remove("hidden");

                currentName = newNameInput.value;

                newNameInput.addEventListener("keyup", () => {
                    if (newNameInput.value.trim() != "") {
                        newNameTrimed = newNameInput.value.trim();
                        if (newNameTrimed != currentName) {
                            sameName.classList.add("hidden");
                            saveNewName.classList.remove("hidden");
                        } else {
                            sameName.classList.remove("hidden");
                            saveNewName.classList.add("hidden");
                        }
                    } else {
                        saveNewName.classList.add("hidden");
                    }
                });
            } else if (editBtns[i].getAttribute("id") == "editInfo") {
                let newInfoInput = document.getElementById("newInfo"),
                    cancelBtn = document.getElementById("cancelInfo");
                    saveBtn = document.getElementById("saveNewInfo"),
                    sameInfo = document.getElementById("errMsgInfo");
                
                newInfoInput.removeAttribute("disabled");
                cancelBtn.classList.remove("hidden");

                currentInfo = newInfoInput.value;

                newInfoInput.addEventListener("keyup", () => {
                    if (newInfoInput.value != "") {
                        if (newInfoInput.value != currentInfo) {
                            saveBtn.classList.remove("hidden");
                            saveBtn.removeAttribute("disabled");
                            sameInfo.classList.add("hidden");
                        } else {
                            saveBtn.classList.add("hidden");
                            saveBtn.setAttribute("disabled", "true");
                            sameInfo.classList.remove("hidden");
                        }
                    } else {
                        saveBtn.classList.add("hidden");
                        saveBtn.setAttribute("disabled", "true");
                    }
                });
            }
        });
    }

    for (let i = 0; i < cancelBtns.length; i++) {
        cancelBtns[i].addEventListener("click", () => {
            location.reload(true);
        });
    }

    deleteBtn.addEventListener("click", function confirmDel (e) {
        if (!confirm('Se eliminará el método de pago')) {
            e.preventDefault();
        }
    });
} else if (document.title == "Metodos de pago" || document.title == "Categorias") {
    
    console.log((document.title == "Metodos de pago") ? "Pagina metodos de pago" : "Pagina categorias");
    
    let info = document.getElementById("noPayMethodsInfo"),
        regNewBtn = document.getElementById("regNewBtn"),
        regNewInfo = document.getElementById("regNewInfo"),
        regNewForm = document.getElementById("regNewForm"),
        iconInput = document.getElementById("methodIcon"),
        iconPreview = document.getElementById("iconPreview");

        regNewBtn.addEventListener("click", () => {
            let cancelBtn = document.getElementById("cancelSaving");

            cancelBtn.addEventListener("click", () => {
                location.reload(true);
            });

            if (document.title == "Categorias") {
                info.innerText = "Ingrese los datos de la nueva categoría";
            } else {
                info.innerText = "Ingrese los datos del nuevo método";
            }
            regNewBtn.classList.add("hidden");
            regNewInfo.classList.add("hidden");
            regNewForm.classList.remove("hidden");

            iconInput.addEventListener("keyup", () => {
                if (iconInput.value.substring(0, 8) == '<i class') {
                    codeArr = iconInput.value.split('<');
                    icon = iconInput.value.substring(iconInput.value.lastIndexOf(">") +1, 0);

                    if (codeArr.length == 3) {
                        iconPreview.innerHTML = icon;
                        iconInput.value = icon;
                    }
                } else if (iconInput.value.substring(0, 1) != '<') {
                    iconInput.value = "";
                }
                // comprobar que no este vacio
                if (iconInput.value != "") {
                    // comprobar que no sea el icono por default
                    if (iconPreview.children[0].attributes.class.value != "fas fa-question-circle") {
                        setNewIcon.classList.remove("hidden");
                        setNewIcon.removeAttribute("disabled");
                    } else {
                        setNewIcon.classList.add("hidden");
                    }
                } else {
                    setNewIcon.classList.add("hidden");
                }
            });
        });

} else if (document.title == "Detalles categoria") {
    console.info("Pagina detalles categoria");

    let swStatus = document.getElementById("switch"),
        toggleHide = document.getElementById("toggleHide"),
        toggleOthers = document.getElementById("toggleOthers"),
        editBtns = [...document.querySelectorAll(".info .options .editBtn")],
        cancelBtns = [...document.querySelectorAll(".info .options .cancelBtn")],
        deleteBtn = document.getElementById("deleteCatBtn");

    swStatus.addEventListener("click", () => {
        let statusBar = document.getElementById("status"),
            statusClass = statusBar.classList[1],
            statusMsg = document.getElementById("statusMsg"),
            closeModal = document.getElementById("closeModal"),
            hideProds = document.getElementById("hideProds"),
            toOthers = document.getElementById("toOthers"),
            toggleMsg = document.getElementById("toggleMsg");
    
        if (statusClass == "inactiva") {
            let setActiveForm = document.getElementById("setActiveForm");

            setTimeout(() => {
                statusBar.classList.remove("inactiva");
                statusBar.classList.add("activa");
                statusMsg.textContent = "La categoría está activa";
            }, 400)

            setTimeout(() => {
                setActiveForm.submit();
            }, 900);

        } else if (statusClass == "activa") {
            modalMsg = document.getElementById("modal");
            modalMsg.classList.add("open");
            toggleMsg.classList.remove("hidden");

            window.addEventListener("keyup", function (e) {
                if (e.keyCode == 27) {
                    modalMsg.classList.remove("open");
                    toggleMsg.classList.add("hidden");
                }
            });

            closeModal.addEventListener("click", () => {
                modalMsg.classList.remove("open");
                toggleMsg.classList.add("hidden");
            });

            hideProds.addEventListener("click", () => {
                modalMsg.classList.remove("open");
                toggleMsg.classList.add("hidden");
                setTimeout(() => {
                    statusBar.classList.remove("activa");
                    statusBar.classList.add("inactiva");
                    statusMsg.textContent = "La categoría está inactiva";
                }, 400)

                setTimeout(() => {
                    toggleHide.submit();
                    console.log("send form");
                }, 900);
            });

            toOthers.addEventListener("click", () => {
                modalMsg.classList.remove("open");
                toggleMsg.classList.add("hidden");
                setTimeout(() => {
                    statusBar.classList.remove("activa");
                    statusBar.classList.add("inactiva");
                    statusMsg.textContent = "La categoría está inactiva";
                }, 400)

                setTimeout(() => {
                    toggleOthers.submit();
                    console.log("send form");
                }, 900);
            });
            
        }
    });

    for (let i = 0; i < editBtns.length; i++) {
        editBtns[i].addEventListener("click", () => {
            for (let j = 0; j < editBtns.length; j++) {
                editBtns[j].classList.add("hidden");

                cancelBtns[j].addEventListener("click", () => {
                    location.reload(true);
                });
            }

            if (editBtns[i].getAttribute("id") == "editName") {
                let saveName = document.getElementById("saveName"),
                    cancelName = document.getElementById("cancelName"),
                    inputName = document.getElementById("catName"),
                    sameName = document.getElementById("sameName")
                    editNameForm = document.getElementById("editName");
                
                cancelName.classList.remove("hidden");
                inputName.removeAttribute("disabled");
                    
                currentName = inputName.value;
                    
                inputName.addEventListener("keyup", () => {
                    if (inputName.value.trim() != "") {
                        if (inputName.value.trim() != currentName) {
                            saveName.classList.remove("hidden");
                            sameName.classList.add("hidden");
                        } else {
                            saveName.classList.add("hidden");
                            sameName.classList.remove("hidden");
                        }
                    } else {
                        saveName.classList.add("hidden");
                    }
                });

                saveName.addEventListener("click", () => {
                    editNameForm.submit();
                })

            } else if (editBtns[i].getAttribute("id") == "editInfo") {
                let saveInfo = document.getElementById("saveInfo"),
                    cancelInfo = document.getElementById("cancelInfo"),
                    inputInfo = document.getElementById("catDesc"),
                    sameInfo = document.getElementById("sameInfo")
                    editDescForm = document.getElementById("editDesc");
                
                cancelInfo.classList.remove("hidden");
                inputInfo.removeAttribute("disabled");
                    
                currentInfo = inputInfo.value;
                    
                inputInfo.addEventListener("keyup", () => {
                    if (inputInfo.value.trim() != "") {
                        if (inputInfo.value.trim() != currentInfo) {
                            saveInfo.classList.remove("hidden");
                            sameInfo.classList.add("hidden");
                        } else {
                            saveInfo.classList.add("hidden");
                            sameInfo.classList.remove("hidden");
                        }
                    } else {
                        saveInfo.classList.add("hidden");
                    }
                });

                saveInfo.addEventListener("click", () => {
                    editDescForm.submit();
                })
            }
        });
    }

    var catImg = document.getElementById("catImg"),
        editImgForm = document.getElementById("editImg");

    catImg.addEventListener("change", () => {
        editImgForm.submit();
    });

    deleteBtn.addEventListener("click", () => {
        let modalMsg = document.getElementById("modal"),
            deleteMsg = document.getElementById("deleteMsg"),
            closeDelete = document.getElementById("closeDelete"),
            prodsNoDisp = document.getElementById("del-noDisp"),
            prodsToOthers = document.getElementById("del-toOthers"),
            prodsDel = document.getElementById("delProds"),
            prodsAction = document.getElementById("prodsAction"),
            delForm = document.getElementById("deleteCatForm"),
            contCat = document.querySelector(".contCatDet");

        modalMsg.classList.add("open");
        deleteMsg.classList.remove("hidden");

        prodsNoDisp.addEventListener("click", () => {
            prodsAction.setAttribute("value", "setProdsNoDisp");

            modalMsg.classList.remove("open");
            deleteMsg.classList.add("hidden");
            contCat.classList.add("deleted");

            setTimeout(()=>{
                delForm.submit(); 
            }, 2000);
        });

        prodsToOthers.addEventListener("click", () => {
            prodsAction.setAttribute("value", "setProdsToOthers");
            
            modalMsg.classList.remove("open");
            deleteMsg.classList.add("hidden");
            contCat.classList.add("deleted");

            setTimeout(()=>{
                delForm.submit(); 
            }, 2000);
        });

        delProds.addEventListener("click", () => {
            prodsAction.setAttribute("value", "deleteProds");
            
            modalMsg.classList.remove("open");
            deleteMsg.classList.add("hidden");
            contCat.classList.add("deleted");

            setTimeout(()=>{
                delForm.submit(); 
            }, 2000);
        });

        window.addEventListener("keyup", function (e) {
            if (e.keyCode == 27) {
                modalMsg.classList.remove("open");
                deleteMsg.classList.add("hidden");
            }
        });

        closeDelete.addEventListener("click", () => {
            modalMsg.classList.remove("open");
            deleteMsg.classList.add("hidden");
        });
    });

}