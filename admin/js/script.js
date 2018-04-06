let updateOrderStatusBtns = [...document.getElementsByClassName('updOrderStat')],
    x = 0;

updateOrderStatusBtns.forEach(() => {
    // console.log(updateOrderStatusBtns[x]);

    updateOrderStatusBtns[x].addEventListener('click', () => {
        console.log('lol' + x);
        
    });
    
    x++;
});



// updateOrderStatusBtn.addEventListener('click', () => {
//     let updateOrderStatusForm = document.getElementById('orderStatusForm'),
//         selectOrderStatus = document.getElementById('sel_status');
        
//     updateOrderStatusBtn.setAttribute('class', 'cancelar');
//     updateOrderStatusBtn.innerText = "Cancelar";
//     updateOrderStatusBtn.setAttribute('id', 'cancelar');

//     let cancelarOrderStatus = document.getElementById('cancelar');

//     cancelarOrderStatus.addEventListener('click', () => {
//         cancelarOrderStatus.style.marginRight = '-100px';

//         setTimeout(() => {
//             location.reload();
//         }, 200);
//     });

//     selectOrderStatus.setAttribute('class', 'sel_stat');

//     selectOrderStatus.addEventListener('change', () => {
//         let submitOrderStatus = document.getElementById('submit_status');

//         selectOrderStatus.style.marginRight = '20px';
//         submitOrderStatus.style.visibility = 'visible';
//     });
// });