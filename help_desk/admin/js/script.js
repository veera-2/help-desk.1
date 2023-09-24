document.querySelector(".img-upload").addEventListener("click", ()=>{document.querySelector("#inf-img").click()});

var form = document.querySelector("#registration_form")
var inpFile = document.querySelector("#inf-img");
var img = document.querySelector(".img");

inpFile.addEventListener("change", (e)=>{

    let file = e.target.files[0];
    

    if (file) {
        let fileName = file.name
        uploadFile(fileName);
    }
    
});

function uploadFile(name){
    
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../scripts/image_check.php", true);
    //xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.upload.addEventListener("progress", ({loaded, total}) => {

       let percentageLoaded = Math.floor((loaded/total) * 100);
       
       document.querySelector("#progress").classList.add("progress");
       document.querySelector("#progress").innerText = percentageLoaded+"%";
       document.querySelector("#progress-bar").style.width = percentageLoaded+"%";
    });

    xhr.onload = function(){
        var url = URL.createObjectURL(inpFile.files[0]);

        if (this.status == 200) {
            
            document.querySelector("#progress").classList.remove("progress");
            document.querySelector("#progress").innerText ="";
            document.querySelector("#progress-bar").style.width = "";

            let imgDetails = JSON.parse(this.responseText);
            let width = imgDetails["width"];
            let height = imgDetails["height"];

            if (height >= width) {
                
                passport.setAttribute("src", url);
                document.querySelector(".img-upload").style.borderColor = "#d0f0c0";
                document.querySelector(".img-upload").style.backgroundColor = "#e6ffe6";
                document.querySelector("#img-error").innerText = "";

                }else{console.log(height+" h -"+width)

                    document.querySelector(".img-upload").style.borderColor = "#ffb5b7";
                    document.querySelector(".img-upload").style.backgroundColor = "#ffdadb";
                    document.querySelector("#img-error").innerText = "poor aspect ratio";
                    img.setAttribute("src", "../imgs/avatar.jpeg" );
                }
        }
    }


    var data = new FormData(form);
    xhr.send(data);
}