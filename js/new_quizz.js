let i = 1;

function plus (){
    let question = document.getElementById("new");
    var clone = question.cloneNode(true);
    clone.id = "new"+ ++i;

    clone.children[1].children[0].children[1].setAttribute("name","intitule"+i);

    let A = clone.children[2].children[0].children[0].children[1]
    A.children[0].children[0].setAttribute("name", "good"+i);
    A.children[1].setAttribute("name", "reponsea"+i);

    let B = clone.children[2].children[0].children[1].children[1]
    B.children[0].children[0].setAttribute("name", "good"+i);
    B.children[1].setAttribute("name", "reponseb"+i);

    let C = clone.children[2].children[1].children[0].children[1]
    C.children[0].children[0].setAttribute("name", "good"+i);
    C.children[1].setAttribute("name", "reponsec"+i);

    let D = clone.children[2].children[1].children[1].children[1]
    D.children[0].children[0].setAttribute("name", "good"+i);
    D.children[1].setAttribute("name", "reponsed"+i);

    question.parentNode.appendChild(clone);

}