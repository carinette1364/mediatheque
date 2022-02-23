let btn_form=document.querySelector('.btn_form');
console.log(btn_form);

let all_input=document.querySelectorAll('.form_input');
console.log(all_input);

btn_form.addEventListener('click', function(e){
    e.preventDefault();
    // let all_input=document.querySelectorAll('.form_input').value;
    // console.log(all_input);
    
    for (let i = 0; i < all_input.length; i++) {
        if (all_input[i].value != "") {
            console.log(all_input[i].id + ' réussi ');
            console.log(all_input[i].value);
        }else{
            console.log(all_input[i].id + ' raté ');
        }
        
    }
})

