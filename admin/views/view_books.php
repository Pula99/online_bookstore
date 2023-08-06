<style>
    table td{
        padding: 6px 12px;
    }
    .thead{
        background-color: #007b73;
        color: #fff;
    }
    
    table, th, td{
        border: 1px solid #000000;
    }

    table th{
        padding: 10px 12px;
    }

    .up_btn{
        background-color: #014c6d;
        color: #fff;
        border: 0px;
        padding: 8px 16px;
        border-radius: 3px;
        cursor: pointer;
    }

    .del_btn{
        background-color: #af1726;
        color: #fff;
        border: 0px;
        padding: 8px 16px;
        border-radius: 3px;
        cursor: pointer;
    }
</style>

<div class="main-container">
    <div class="wrapper">
        <div id="bookTable" style="overflow: auto;"></div>
    </div>
</div>

<script>
    function displayBooks(xmlData) {
        const parser = new DOMParser();
        const xmlDoc = parser.parseFromString(xmlData, 'text/xml');
        const books = xmlDoc.getElementsByTagName('book');

        let tableHTML = '<table cellspacing="0"><thead class="thead"><tr><th>Book ID</th><th>Book Name</th><th>Author</th><th>Publisher</th><th>Category</th><th>ISBN Number</th><th>Price</th><th>Discount</th><th>Status</th><th>Handled By</th><th>Created Date</th><th>Actions</th></tr></thead><tbody>';

        for (let i = 0; i < books.length; i++) {
            const book = books[i];
            const bookId = book.querySelector('book_id').textContent;
            const bookName = book.querySelector('book_name').textContent;
            const author = book.querySelector('author').textContent;
            const publisher = book.querySelector('publisher').textContent == '' ? 'N/A' : book.querySelector('publisher').textContent;
            const categoryName = book.querySelector('category_name').textContent;
            const isbnNo = book.querySelector('isbn_no').textContent;
            const price = book.querySelector('price').textContent;
            const discount = book.querySelector('discount').textContent;
            const status = book.querySelector('status').textContent;
            const handledBy = book.querySelector('handled_user').textContent;
            const createdDate = book.querySelector('c_date').textContent;

            tableHTML += `<tr>
                <td>${bookId}</td>
                <td>${bookName}</td>
                <td>${author}</td>
                <td>${publisher}</td>
                <td>${categoryName}</td>
                <td>${isbnNo}</td>
                <td>${price}</td>
                <td>${discount}</td>
                <td style="text-transform: capitalize;">${status}</td>
                <td>${handledBy}</td>
                <td>${createdDate}</td>
                <td>
                    <button class="up_btn" onclick="updateBook(${bookId})">Update</button>
                    <button class="del_btn" onclick="deleteBook(${bookId})">Delete</button>
                </td>
            </tr>`;
        }

        tableHTML += '</tbody>';
        tableHTML += '</table>';
        document.getElementById('bookTable').innerHTML = tableHTML;
    }

    // Replace 'path/to/books.xml' with the actual path to your XML file
    fetch('/online_bookstore/books/books.xml?timestamp=<?=date('YmdHis')?>')
        .then(response => response.text())
        .then(xmlData => {
            displayBooks(xmlData);
        })
        .catch(error => {
            console.error('Error fetching XML data:', error);
        });

    // Function to handle update button click
    function updateBook(bookId) {
        window.location.href = '/online_bookstore?page=Update_books&book_id='+bookId;
    }

    // Function to handle delete button click
    function deleteBook(bookId) {
        const isConfirmed = window.confirm("Are you sure you want to delete this book?");
        if (!isConfirmed) {
            return;
        }

        try{
            fetch('admin/Ajax.php?ajax=delete_book&book_id='+bookId, 
                {
                    method: 'GET',
                    headers: {
                        'X-Ajax-Request': 'true', // to identify AJAX requests
                    },
                }
            )
            .then(response => response.json())
            .then(data => {
                if(data.status == 'success') {
                    alert("Book deleted successfully.");
                    location.reload();
                }else{
                    alert("Something went wrong...");
                }
            })
        }catch(error){
            console.log(error);
        }
        
    }
</script>
