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
    console.log("Detalles producto");

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
}