var limit = document.querySelector("#admin_num_records").value;
var offset = 0;
var current_page= 0 ;

document.querySelector("#admin_num_records").addEventListener("change",()=>{
    limit = document.querySelector("#admin_num_records").value;
    getAdmins(limit, offset);
    setPagination(limit, curent_page)
});

function getAdmins (limit, offset){
     let xhr = new XMLHttpRequest();

     let param = "get=admins&limit="+limit+"&offset="+offset;
     document.querySelector("#admin_table_data").innerHTML='';

    xhr.open('POST', 'scripts/admins.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function(){
        if (this.status == 200) {

            admins = JSON.parse(this.responseText)

            let output = "";

            for (let i in admins) {
                
                    output += '<tr>'+
                    '<td>'+admins[i].name+'</td>'+
                    '<td>'+admins[i].username+'</td>'+
                    '<td>'+admins[i].id+'</td>'+
                    '<td>'+admins[i].phoneNumber+'</td>'+
                    '<td>'+admins[i].eMail+'</td>'+
                    '</tr>';

            }
            document.querySelector("#admin_table_data").innerHTML = output;
        }
    }
    xhr.send(param);
}

function page_navigation(page, page_count){
    curent_page = page;
    let btns = document.querySelector(".pagination-btns").children;
    let btn = btns[page - 1];
    console.log(btn);
    
    if (page > 1) {
        offset = limit * (page - 1);
    }else{
        offset = 0;
    }
    for (let i = 0; i < btns.length; i++) {
        btns[i].classList.remove("active-nav-btn");
        
    }
    btn.classList.add("active-nav-btn");
    getAdmins(limit, offset);
    setPagination(limit, current_page)
}

function setPagination(limit, current_page){
    document.querySelector(".pagination-btns").innerHTML='';
    let xhr = new XMLHttpRequest();
    let param = "get=adminsLength";
    let buttons_container = document.querySelector(".pagination-btns");

    xhr.open('POST', 'scripts/admins.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function(){
        if (this.status == 200) {
            let length = JSON.parse(this.responseText)[0];
            page_count = Math.ceil(length/limit);

            for (let i = 1; i < page_count+1; i++) {
                let btn = document.createElement("button");
                btn.classList.add("pagination-btn");
                btn.innerText = i;
                btn.setAttribute("onclick", "page_navigation("+i+","+page_count+");");
                buttons_container.appendChild(btn);
            }
            
            document.querySelector(".pagination-btns").children[current_page].classList.add("active-nav-btn");
        }
    }
    xhr.send(param);
}

window.onload = function (){
    getAdmins(limit, offset);
    setPagination(limit, 0);
}
