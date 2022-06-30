
// const question = document.querySelectorAll("#question > ");


// question.forEach((carte) =>{

//     let valide = carte.querySelector(".valide");

//         valide.addEventListener('click', () => {

//             carte.style.display = "none"

//         })

// })

let question = document.querySelectorAll(".question");
let count = 0
let i = 2;

question.forEach(carte =>{

    // pour le cache des quizz
    if(count > 0){
        carte.style.display = "none";
        console.log("salut");
    }

    count++;

    //gestion des bouttons
    let bouton = carte.querySelectorAll(".valide");
   
    bouton.forEach(reponse =>{
        reponse.addEventListener('click', () => {

            carte.style.display = "none";
            document.getElementById("carte"+i).style.display = "block";
            console.log(reponse.value);
            if(i == count){
                document.getElementById("bouton"+i).setAttribute("type", "submit")
            }
            i++;
        })
    })
})