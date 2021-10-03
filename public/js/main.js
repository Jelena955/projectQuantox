window.onload=function(){


    var cat=document.getElementsByClassName("cat");
    var i=0;

    for(i;i<cat.length;i++){
        cat[i].addEventListener("click", filtercat);
    }

    let buttonsearch=document.getElementById('buttonsearch');
    buttonsearch.addEventListener("click", search)


}
const token = $('meta[name="csrf-token"]').attr('content');
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN':token
    },
    async:false
});



function search(e){
    e.preventDefault()
    let search=document.getElementById('search').value;


    $.ajax({
        async: true,
        type: "GET",
        url: `http://localhost:8080/search`,
        data:{search:search},

        dataType: "json",

        success: function(data){

            searchb(data);


        },
        error: function(xhr, status, error) {
            alert(xhr.responseText);
        }
    });

}
function filtercat(e){
    e.preventDefault()
    let id=this.id;
//console.log('dsds')


    $.ajax({
        async: true,
        type: "GET",
        url: `http://localhost:8080/category`,
        data:{id:id},

       dataType: "json",

        success: function(data){
           // alert(data)
     // let print='<h1>cxec</h1>'
       console.log(data);
            writeCategory(data);


        },
        error: function(xhr, status, error) {
            alert(xhr.responseText);
        }
    });
}
function  writeCategory(data){


    let ispis=''
    for (d of data){
        var idcategory=d.idcategory


        ispis+=`<div class='col-sm-6' >
        <div class='card '>
            <div class='card-body '>
                <h5 class='card-title '>${d.titlee}</h5>
                
                <a href= '#' id=${d.newsid}class='btn btn-primary'>More</a>
            </div>
        </div>
    </div>`
    }
   // let category=idcategory;
    let ispis2='<h1>Subscribe to this category</h1> </br> <div class="input-group flex-nowrap">\n'

     let ispis3=`
        '<input type="text"  class="form-control" name="submail" id="mail" placeholder="Email" aria-label="Email" aria-describedby="addon-wrapping">'
        '<button type="submit" name="cat" id="submit"> Subscribe</button>`

    $('#vesti').html(ispis);
    console.log(data)
    if(idcategory!='all'){


   $('#forma').append(ispis3);
    $('#subscribe').html(ispis2);
   // $('#forma').(ispis3);
    let mail=document.getElementById('submit')
    mail.value=idcategory;

}
    let submit=document.getElementById('submit');
    //submit.addEventListener("click", writeSubscribes)

}

function searchb(data){

    let ispis=''

    for (d of data){


        ispis+=`<div class='col-sm-6' >
        <div class='card '>
            <div class='card-body '>
                <h5 class='card-title '>${d.titlee}</h5>
                
                <a href= '#' id=${d.newsid}class='btn btn-primary'>More</a>
            </div>
        </div>
    </div>`
    }

    $('#vesti').html(ispis);


}

function writeSubscribes(e){

    e.preventDefault()
    let id=this.name;
//console.log('dsds')


    $.ajax({
        async: true,
        type: "GET",
        url: `http://localhost:8080/insertsubscribes`,
        data:{id:id},

        dataType: "json",

        success: function(data){
            // alert(data)
            // let print='<h1>cxec</h1>'
           alert('Succesfuly')



        },
        error: function(xhr, status, error) {
            alert(xhr.responseText);
        }
    });}