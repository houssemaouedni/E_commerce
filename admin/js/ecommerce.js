class Ecommerce {
  constructor() {
    this.api_key = "h11059586";
    this.api = "http://localhost/projet-ecommerce/api/api/";
    this.action = ["users", "category", "product", "order"];
    this.data = [];
    this.initDataApp();
    this.initRouter();
  }

  initRouter() {
    this.action.forEach((action) => {
      document.getElementById(action).addEventListener("click", () => {
        fetch("templates/" + action + ".html")
          .then((repense) => {
            if (repense.ok) {
              // console.log(repense);
              return repense.text();
            } else {
              console.log("erreur de chargement");
            }
          })
          .then((data) => {
            document.getElementsByClassName("container-fluid")[1].innerHTML =
              data;
            if (action == "product") {
              this.loadProduct();
            }
            if (action == "category") {
              this.loadCategory();
            }
            if (action == "order") {
              this.loadorder();
            }
            if (action == "users") {
              this.loadUsers();
            }
          });
      });
    });
  }
  initDataApp() {
    this.action.forEach((action) => {
      const url = this.api + action + "?API_KEY=" + this.api_key;
      fetch(url)
        .then((repense) => {
          if (repense.ok) {
            return repense.json();
          } else {
            console.log("Erreur de chargement de donner");
          }
        })
        .then((respense) => {
          if (respense.status == 200) {
            this.data.push({ name: action, data: respense.result });
            // localStorage.setItem(action,JSON.stringify(respense.result));
          }
        });
    });
  }
  getData(entity) {
    var object = this.data.find((element) => element.name == entity);
    return object.data;
    // return JSON.parse(localStorage.getItem(entity)) ? JSON.parse(localStorage.getItem(entity)):[];
  }
  loadProduct() {
    $("#dateTable").DataTable({
      data: this.getData("product"),
      columns: [
        { data: "idProduit" },
        { data: "name" },
        { data: "description" },
        {
          data: "price",
          render: function (data, type, row) {
            return "TND" + data;
          },
        },
        { data: "category" },
        { data: "stock" },
        { data: "createdAt" },
        {
          data: "idProduit",
          render: function (id, type, row) {
            return `<button
            type="button"
            class="btn btn-success btn-sm"
            data-bs-toggle="modal"
            data-bs-target="#updateProduit${id}">
            <i class="bi bi-x-octagon"></i>
            upload
          </button>
          <button
            type="button"
            class="btn btn-danger btn-sm"
            data-bs-toggle="modal"
            data-bs-target="#deleteProduit${id}">

            DELETE
          </button>
          <div
          class="modal fade"
          id="updateProduit${id}"
          data-bs-backdrop="static"
          data-bs-keyboard="false"
          tabindex="-1"
          aria-labelledby="staticBackdropLabel"
          aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update produit</h5>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>
              <div class="modal-body">
                <form action="" id="formUpdateProduit-${id}">
                  <div class="input-group">
                    <span class="input-group-text">Name : </span>
                    <input
                      type="text"
                      aria-label="name"
                      name="name"
                      value="${row.name}" 
                      class="form-control"
                    />
                  </div>
                  <div class="input-group mt-3">
                    <span class="input-group-text">Description : </span>
                    <textarea
                      type="text"
                      cols="30"
                      rows="10"
                      name="description"
                      class="form-control"
                    >${row.description}</textarea>
                  </div>
                  <div class="input-group mt-3">
                    <span class="input-group-text">Price : </span>
                    <input
                      type="number"
                      value="${row.price}"
                      aria-label="name"
                      name="price"
                      class="form-control"
                    />
                  </div>
                  <div class="input-group mt-3">
                    <span class="input-group-text">category : </span>
                    <input
                      type="number"
                      aria-label="name"
                      name="category"
                      value="${row.category}"
                      class="form-control"
                    />
                  </div>
                  <div class="input-group mt-3">
                    <span class="input-group-text">stock : </span>
                    <input
                      type="number"
                      aria-label="name"
                      name="stock"
                      value="${row.stock}"
                      class="form-control"
                    />
                  </div>
                  <div class="input-group mt-3">
                    <span class="input-group-text">image: </span>
                    <input
                      type="file"
                      aria-label="name"
                      name="image"
                      class="form-control"
                    />
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  id="close"
                  class="btn btn-secondary"
                  data-bs-dismiss="modal"
                >
                  Close
                </button>
                <button type="button" data-bs-dismiss="modal" onclick="updateProduct(${id}, '${row.image}')" class="btn btn-primary" >
                  update Product
                </button>
              </div>
            </div>
          </div>
        </div>
        
        
        <div
          class="modal fade" id="deleteProduit${id}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteproduitLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="deleteproduitLabel">Delete produit</h5>
                <button
                  type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>Are you sure ! you want to delete this product? We remind you that this action is irreversible !</p>
              </div>
              <div class="modal-footer">
                <button
                  type="button" id="close" class="btn btn-secondary" data-bs-dismiss="modal"> Close </button>
                <button type="button" data-bs-dismiss="modal" onclick="deleteProduct(${id})" class="btn btn-danger" >
                  Delete Product
                </button>
              </div>
            </div>
          </div>
        </div>
        
        
        
        
        
        `;
          },
        },
      ],
    });
  }
  loadCategory() {
    $("#dateTable").DataTable({
      data: this.getData("category"),
      columns: [{ data: "idCategory" }, { data: "name" }],
    });
  }
  loadUsers() {
    $("#dateTable").DataTable({
      data: this.getData("users"),
      columns: [
        { data: "idUser" },
        { data: "email" },

        { data: "firstname" },
        { data: "lastname" },
      ],
    });
  }
  loadorder() {
    $("#dateTable").DataTable({
      data: this.getData("order"),
      columns: [
        { data: "idOrder" },
        { data: "idUser" },
        { data: "idProduct" },
        { data: "quantity" },
        { data: "price" },
        { data: "created_at" },
      ],
    });
  }
}

export { Ecommerce };
