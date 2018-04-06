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