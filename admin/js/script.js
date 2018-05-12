if (document.title == 'Pedidos') {

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

} else if (document.title == 'Productos') {

    let deleteProducts = [...document.getElementsByClassName('delProd')],
        editProducts = [...document.getElementsByClassName('editProd')];
    
    for (let i = 0; i < deleteProducts.length; i++) {
        deleteProducts[i].addEventListener('click', function confirmProdDel (e) {
            if (!confirm('Se eliminará permanentemente el producto.\n\nSi solamente desea que no se muestre al cliente.\n\nConsidere mejor desactivar la disponibilidad.\n\n\nPulse Aceptar para continuar con la eliminación.\n\n\n')) {
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

}