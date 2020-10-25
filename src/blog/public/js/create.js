marked.setOptions({breaks : true});

var IDDivHtmlArea = document.getElementById("IDDivHtmlArea");
let form_textarea = document.querySelector(".form_textarea");
let hidden = document.querySelector(".hidden");

form_textarea.addEventListener("input",()=>{
    IDDivHtmlArea.innerHTML = marked(form_textarea.value);
    hidden.value = marked(form_textarea.value);
})
