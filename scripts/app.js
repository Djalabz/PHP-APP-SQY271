// ANIMATION SUPPRESSION COMMENTAIRE

// Je récupère l'ensemble de icones la croix qui permettent de supprimer un comment
const crossBtn = document.querySelectorAll(".cross-btn")

// Pour chaque icone de type croix je viens écouter lorsque le user clique
crossBtn.forEach(btn => {
    btn.addEventListener("click", () => {
        // Lors du click je viens ajouter les classes afin d'animer ma div de comment 
        // en accédant au grand-grand-parent de mon icone de fermeture 
        btn.parentNode.parentNode.parentNode.classList.add("animate__animated",  "animate__bounceOut")
    })
})


// TODO APP 

// Récupérer contenu de l'input lors du click
// vérifier que ce ne soit pas vide 
// l'afficher dans la zone des todos

const todoInput = document.querySelector("#todo-input")
const todoSubmit = document.querySelector(".todo-submit")
const todosList = document.querySelector(".todos-zone")

todoSubmit.addEventListener("click", () => {
    if (todoInput.value != "") {
        // Je créee un élément HTML avec pour balise div
        let todoDiv = document.createElement("div")
        // Il faudra ajouter de bons styles pour la todo 
        todoDiv.classList.add("border", "rounded")

        // Il faudra ajouter les bons boutons pour chaque todo ici ... 
        // Il faut donc réfléchir à la logique JS derrière ces boutons ...

        // J'injecte du contenu texte dans cette div à savoir la valeur de mon input aka la todo
        todoDiv.textContent = todoInput.value
        // Je viens "append" cad injecter ma todo fraichement créee dans ma liste de todos 
        todosList.append(todoDiv)
    }
})

// Améliorer la todo : 

// 1 - Faire en sorte que chaque todo affichée ait une vraie tete de todo (cf tailwind)
// 2 - Il faut qu'elle ait un bouton de modification, de validation (pour checker) et de suppressin
// Que ces boutons soient fonctionnels 
// 3 - Le bouton de check doit afficher notre todo avec une faible opacité et le contenu texte barré 
// BONUS : Une animation pour chaque todo ajoutée (type pop up ou autre voir animate css)
  