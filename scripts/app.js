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
        todoDiv.classList.add("relative")
        // Il faudra ajouter de bons styles pour la todo 
        todoDiv.innerHTML = `<a href="#" class="mt-2 bg-neutral-primary-soft block max-w-sm p-6 border border-default rounded-base shadow-xs hover:bg-neutral-secondary-medium">
                <h5 class="todoContent mb-3 text-xl font-semibold tracking-tight text-heading leading-8">` + todoInput.value + `</h5>
        </a>`

        // Création des boutons (ou plutot mes inputs et img qui serviront de boutons) pour chaque div
        let checkBtn = document.createElement("div")
        let editBtn = document.createElement("a")
        let closeBtn = document.createElement("a")

        // Je donne du contenu à mes boutons 
        checkBtn.innerHTML = `<input class="w-4" type="checkbox" />`
        editBtn.innerHTML = `<img class="w-6 " src="./assets/icons/edit.svg" />`
        closeBtn.innerHTML = `<img class="w-6 " src="./assets/icons/close-cross.svg" >`

        // Logique du bouton check -> on écoute le click et on change les classes pour ajouter la ligne 
        // et modifier l'opacité 
        checkBtn.addEventListener("click", () => {
            todoDiv.classList.toggle("line-through")
            todoDiv.classList.toggle("opacity-50")

        }) 

        // Bouton d'edit de todo -> Avec prompt on affiche une popup dans laquelle on rentre la todo modifiée
        // On récupère le h5 en passant ^pâr les Nodes enfants de notre todo div
        editBtn.addEventListener("click", () => {
            let newTodo = prompt("Modifiez votre todo : ")

            if (newTodo != "") {
                todoDiv.childNodes[0].childNodes[1].textContent = newTodo
            }
        })

        // Bouton de suoppression -> quand on cliquie dessus on veut supprimer la todo de notre liste de todos
        closeBtn.addEventListener("click", () => {
            // Avec remove() on supprime la todo désirée
            todoDiv.remove()
        })

        // Je regroupe mes boutons dans une div parent 
        let divBtns = document.createElement("div")
        // J'ajoute des classes tailwind pour styliser mon ensemble de boutons 
        divBtns.classList.add("flex", "absolute", "top-0", "right-0")
        // Je regroupe mes boutons dans une div commune pour des soucis de style
        divBtns.append(checkBtn, editBtn, closeBtn)
        
        // J'ajoute ma div de boutons à ma div de todo
        todoDiv.append(divBtns)

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
  