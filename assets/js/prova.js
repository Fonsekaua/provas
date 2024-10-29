const button__prova = document.querySelectorAll(".section__prova button")
button__prova.forEach(button_prova => {
    button_prova.addEventListener("click",()=>{
    console.log(button_prova.id)

    })
})