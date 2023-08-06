<div class="main-container">
    <div class="wrapper">
        <div class="container">
            <h2 class="h2"><?=(isset($_GET["book_id"]) ? 'Update Book' : 'Add Book')?></h2>
            <form action="/" method="post" id="book_form">
                <input type="hidden" name="book_id" id="book_id" value="">
                <div class="form-group">
                    <label class="label" for="book_name">Book Name <span style="color:red;">*</span></label>
                    <input type="text" class="form-control" id="book_name" name="book_name" required>
                </div>

                <div class="form-group">
                    <label class="label" for="author">Author <span style="color:red;">*</span></label>
                    <input type="text" class="form-control" id="author" name="author" required>
                </div>

                <div class="form-group">
                    <label class="label" for="publisher">Publisher</label>
                    <input type="text" class="form-control" id="publisher" name="publisher">
                </div>

                <div class="form-group">
                    <label class="label" for="category_id">Category <span style="color:red;">*</span></label>
                    <div style="display: flex; flex-direction: row;">
                        <select class="form-control" name="category_id" style="background: transparent; flex: 0.9; border-top-right-radius: 0px; border-bottom-right-radius: 0px;" id="category_id" required>
                            <option value="">Select Category</option>
                        </select>
                        <button type="button" class="add-category-btn submit_btn" style="flex: 0.1; border-top-left-radius: 0px; border-bottom-left-radius: 0px;" onclick="openModal()"><i class="fas fa-plus"></i></button>
                    </div>
                    
                </div>

                <div class="form-group">
                    <label class="label" for="isbn_no">ISBN Number <span style="color:red;">*</span></label>
                    <input type="text" class="form-control" id="isbn_no" name="isbn_no" required>
                </div>

                <div class="form-group">
                    <label class="label" for="price">Price <span style="color:red;">*</span></label>
                    <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                </div>

                <div class="form-group">
                    <label class="label" for="discount">Discount</label>
                    <input type="number" class="form-control" id="discount" name="discount" step="0.01">
                </div>

                <div class="form-group">
                    <label class="label" for="book_photo">Book Photo <span style="color:red;">*</span></label>
                    <input type="file" class="form-control" id="book_photo" name="book_photo" accept="image/*" required>
                </div>

                <div class="form-group">
                    <label class="label" for="book_pdf">Book PDF <span style="color:red;">*</span></label>
                    <input type="file" class="form-control" id="book_pdf" name="book_pdf" accept="application/pdf" required>
                </div>

                <button type="submit" class="submit_btn" id="add_book_btn"><?=(isset($_GET["book_id"]) ? 'Update Book' : 'Add Book')?></button>
            </form>
        </div>
    </div>
</div>


<div class="modal" id="modal">
    <div class="modal-content">
        <h2>Add New Category</h2>
        <form action="/" method="post" id="category_form">
            <div class="form-group">
                <label class="label" for="new_category">Category Name <span style="color:red;">*</span></label>
                <input type="text" class="form-control" id="new_category" name="new_category" required>
            </div>
            <button type="submit" class="submit_btn">Add Category</button>
        </form>
        <button class="close-btn" onclick="closeModal()">Close</button>
    </div>
</div>


<script>
<?php if(isset($_GET["book_id"])){ ?>
    try{
        fetch('admin/Ajax.php?ajax=get_book_by_id&book_id=<?=$_GET["book_id"]?>', 
            {
                method: 'GET',
                headers: {
                    'X-Ajax-Request': 'true', // to identify AJAX requests
                },
            }
        )
        .then(response => response.json())
        .then(data => {
            getCategories().then(() => {
                if(data.book_id) {
                    document.getElementById('add_book_btn').disabled = true;
                    document.getElementById('book_id').value = data.book_id;
                    document.getElementById('book_name').value = data.book_name;
                    document.getElementById('author').value = data.author;
                    document.getElementById('publisher').value = data.publisher;
                    const categorySelect = document.getElementById('category_id');
                    for (let i = 0; i < categorySelect.options.length; i++) {
                        const option = categorySelect.options[i];
                        if (option.value === data.category_id.toString()) {
                            option.selected = true;
                            categorySelect.value = data.category_id.toString();
                            setTimeout(() => {
                                categorySelect.options[i].textContent = option.text;
                            }, 0);
                            break;
                        }
                    }
                    document.getElementById('isbn_no').value = data.isbn_no;
                    document.getElementById('price').value = data.price;
                    document.getElementById('discount').value = data.discount;
                    document.getElementById('add_book_btn').disabled = false;
                }else{
                    console.log("Something went wrong...");
                }
            });
        })
    }catch(error){
        console.log(error);
    }
<?php }else{ ?>
    getCategories();
<?php } ?>
//-------------------------------------------------------------------------------
document.addEventListener('DOMContentLoaded', function(){
//-------------------------------------------------------------------------------
//when submitting the add book form
    const form = document.getElementById('book_form');
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        const formData = new FormData(form);

        // Add the image and PDF files to the FormData object
        const bookPhotoInput = document.getElementById('book_photo');
        const bookPDFInput = document.getElementById('book_pdf');
        formData.append('book_photo', bookPhotoInput.files[0]);
        formData.append('book_pdf', bookPDFInput.files[0]);

        try {
            fetch('admin/Ajax.php?ajax=add_book', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Ajax-Request': 'true', // to identify AJAX requests
                },
            })
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    alert("Something went wrong...");
                    console.error('Error occurred.');
                }
            })
            .then((data) => {
                if (data.status === "success") {
                    if(document.getElementById("book_id").value != ""){
                        alert("Book updated successfully!!!");
                        window.location.href = '/online_bookstore?page=View_books';
                        return;
                    }
                    resetForm();
                    alert("Book added successfully!!!");
                } else {
                    alert(data.msg);
                }
            })
            .catch(error => {
                alert("Something went wrong...");
                console.error('Error:', error);
            });
        } catch (error) {
            alert("Something went wrong...");
            console.error('Error:', error);
        }
    });
//-------------------------------------------------------------------------------
//when submitting the add category form
    const catForm = document.getElementById('category_form');
    catForm.addEventListener('submit', function (event) {
        event.preventDefault();
        const catFormData = new FormData(catForm);

        try{
            fetch('admin/Ajax.php?ajax=add_category', {
                method: 'POST',
                body: catFormData,
                headers: {
                    'X-Ajax-Request': 'true',
                }
            })
            .then(response => {
                if(response.ok){
                    return response.json();
                }else{
                    alert("Something went wrong...");
                    console.error('Error occured.');
                }
            })
            .then((data) => {
                if(data.status == "success"){
                    getCategories();
                    document.getElementById('new_category').value = "";
                    alert("Category added successfully!!!");
                    closeModal();
                }else{
                    alert(data.msg);
                }
            })
            .catch(error => {
                alert("Something went wrong...");
                console.error('Error:', error);
            });
        }catch(error){
            alert("Something went wrong...");
            console.error('Error:', error);
        }
        
    });
//-------------------------------------------------------------------------------
});
//-------------------------------------------------------------------------------
// reset form
    function resetForm() {
        const form = document.getElementById('book_form');
        form.reset();
    }
//-------------------------------------------------------------------------------
// for model open
    function openModal() {
        const modal = document.getElementById('modal');
        modal.style.display = 'block';
    }

    function closeModal() {
        const modal = document.getElementById('modal');
        modal.style.display = 'none';
    }
//-------------------------------------------------------------------------------
// for get categories
    async function getCategories() 
    {
        document.getElementById('category_id').disabled = true;
        document.getElementById('add_book_btn').disabled = true;

        try{
            await fetch('admin/Ajax.php?ajax=get_categories', {
                method: 'GET',
                headers: {
                    'X-Ajax-Request': 'true'
                }
            })
            .then(response => {
                if(response.ok){
                    return response.json();
                }else{
                    console.error('Error occured.');
                }
            })
            .then((data) => {
                let list = '<option value="">Select Category</option>';
                data.map(function(val, i){
                    list += '<option value="'+val.category_id+'">'+val.category_name+'</option>';
                });
                document.getElementById('category_id').innerHTML = list;
                document.getElementById('category_id').disabled = false;
                document.getElementById('add_book_btn').disabled = false;
            })
        }catch(error){
            console.log(error);
        }
    }
//-------------------------------------------------------------------------------
</script>

    
