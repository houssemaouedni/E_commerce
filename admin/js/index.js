
const api_key ="h11059586";
const api = "http://localhost/projet-ecommerce/api/api/";
const uplod_Image_URL ="http://localhost/projet-ecommerce/api/api/uploadImage.php?"


//-------Add product----------
addProduct = () => {
    let formProduit = document.getElementById('formProduit')
    let data = new FormData(formProduit);
    let fileProduct = data.get("image");
    let name = data.get("name")
    data.set("image", data.get("image").name);
    data.append("API_KEY",api_key);
  //-----------connection au api------------//
  const url = api+'Product?';
  fetch(url,
    {method:"POST",
     body: data}
     ).then((repense) =>{
      if(repense.ok){
          return repense.json();
        }
  }).then((repense) =>{
      if(repense.status == 200){
          uplodImage(fileProduct);  
          var table = $("#dateTable").DataTable();
          var tableLenth = table.rows().data().length;
          var id = table.row(tableLenth - 1).data()["idProduit"] +1;
            let products = {
                idProduit:id,
                name: data.get("name"),
                description: data.get("description"),
                price: data.get("price"),
                stock: data.get("stock"),
                image: data.get("image"),
                createdAt: new Date().toISOString().slice(0, 19).replace('T', ' '),
            }
            table.row.add(product).draw();
          document.getElementById("formProduit").reset();
          document.getElementById('close').click();
          alert("ajout avec success");
      }else{
          console.log(repense.status);
      }
  })
  
}
//-------Update Produit------------
updateProduct = (id,imageName) =>{
    let formUpdateProduit = document.getElementById("formUpdateProduit-"+id);
    let data = new FormData(formUpdateProduit);
    data.append('idproduit',id);
    let imageToUpload = data.get("image");
    if(imageToUpload.name !==""){
        data.set("image", imageToUpload.name);
    }else{
        data.set("image", imageName);
    }
    let dataValue = {};
    for(var value of data.entries()){
        dataValue[value[0]] = value[1];
    }
    const url = api+'produit?'+constructUrlParams(dataValue)+'API_KEY='+api_key;
    
    fetch(url, {method:"PUT"}).then((repense) =>{
        if(repense.ok){
            return repense.json();
        }else{
            console.log("Erreur déclenchée lors de l'exécution de la requete de mise a jour du produit");
        }
    }).then((result) =>{
        if(result.status == 200){
            if(imageToUpload.name !==""){
                uplodImage(imageToUpload);
                deleteImage(imageName);
            }
            var table = $("#dateTable").DataTable();
            var products = table.rows().data();
            var product = products.filter(element => element.idProduit == id)[0];
            var index = products.indexOf(product);
            product.name = dataValue.name;
            product.description = dataValue.description;
            product.price = dataValue.price;
            product.stock = dataValue.stock;
            product.category = dataValue.category;
            product.image = dataValue.image;
            $("#dateTable").dataTable().fnUpdate(product,index,undefined,false);
        }else{
            console.log(result.message);
        }
    })
}
//--------boucle de parametre------------//
constructUrlParams = (object)=>{
    result = '';
    for(const property in object  ){
        result += `${property}=${object[property]}&`
        
    }
    return result
}
//--- Upload Image ---------//
uplodImage = (file) =>{
 let data = new FormData();
 data.append("image", file);
 data.append("API_KEY", "h11059586")
 fetch(uplod_Image_URL,{
     method: "POST",
     body: data
 }).then((repense) => {
     if(repense.ok){
         return repense.json();
     }
 }).then((result) =>{
     if(result.status == 200){
        console.log("images uplod avec success");

     }else{

        console.log(result.message);
     }
 })
}
//------delete Image-------//
deleteImage = (name) =>{
    const url = api + 'image?name='+name+'&API_KEY='+api_key;

    fetch(url ,{method: 'DELETE'}).then((repense) =>{
        if(repense.ok){
            return repense.json();
        }else{
            console.log("Erreur lor de l'exucition du recet");
        }
    }).then((result) => {
        if(result.status == 200){
            console.log(result.result);
        }else{
            console.log(result.message);
        }
    })

}
//---------Add USers-------------//
addUsers = () => {
    let formUsers = document.getElementById('formUsers');
    let data = new FormData(formUsers)
    data.append("API_KEY",api_key)
    const url = api+'Users?';
    fetch(url,
        {method:"POST",
         body: data
        }).then((repense) =>{
        if(repense.ok){
            return repense.json();
          }
    }).then((repense) =>{
        if(repense.status){
            alert("ajout avec success")
            document.getElementById("formUsers").reset()
            // document.getElementById('close').click();
        }else{
            console.log(repense.status);
        }
    })
    
  }
deleteProduct = (id) =>{
    const url = api+"produit?id="+id+"&API_KEY="+api_key;
    fetch(url,{method: "DELETE"}).then((repense) =>{
        if(repense.ok){
            return repense.json()
        }else{
            console.log("Erreur déclenchée lors de l'execution de la requete de suppression du produit");
        }
    }).then((result)=>{
        if(result.status == 200){
            var table = $("#dateTable").DataTable();
            var products = table.rows().data();
            var product = products.filter(element => element.idProduit == id)[0];
            var index = products.indexOf(product);
            $("#dateTable").dataTable().fnDeleteRow(index);
            deleteImage(product.image);
        }else{
            console.log(result.message);
        }
    })
}