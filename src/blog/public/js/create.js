marked.setOptions({breaks : true});

var IDDivHtmlArea = document.getElementById("IDDivHtmlArea");
let form_textarea = document.querySelector(".form_textarea");
let hidden = document.querySelector(".hidden");

function create_index(str){
    str = str.replace(/@index/,(match)=>{
        console.log(match);
        let index_text = "";
        document.querySelectorAll("h2").forEach((el)=>{
            index_text+="<li>"+el.textContent+"</li>"
        });
        let changed_str = `<div class='content-index'>
        <div class="content-index-title"><img src="/img/menu.png" alt="menu"><span>目次</span></div><ul class="content-index-list">`+index_text+`</ul></div>`;
        return changed_str;
    });
    return str;
}

form_textarea.addEventListener("keyup",()=>{
    let text = marked(form_textarea.value);
    console.log(text);
    IDDivHtmlArea.innerHTML = create_index(text);
    hidden.value = create_index(text);
})


