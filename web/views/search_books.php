<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Online Book Store</title>
    <link rel="stylesheet" href="web/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <style>
        .banner-content{
            height: 80px;
            width: 100%;
            bottom: 60px;
            position: absolute;
            background-color: #00000075;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .text-muted{
            color: #ababab;
            font-size: 20px;
        }

        .search_placeholder{
            width: 100%;
            height: 200px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: row;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            background-color: #fff;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="number"]:focus,
        select:focus {
            outline: none;
            border-color: #00AA91;
        }

        select{
            min-width: 200px;
        }

        button {
            background-color: #00AA91;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
            width: 100%;
            margin-left: 30px;
            border: 1px solid #fff;
        }

        button:hover {
            background-color: #007B73;
        }
    </style>

</head>

<body>

    <section>

        <?php include('web/views/nav.php') ?>
        
        <div class="banner" style="position: relative;">
            <div class="banner-content">
                <div>
                    <input type="text" placeholder="Enter book name" id="book_name">
                </div>
                <div>
                    <input type="number" placeholder="Enter price (Lower)" id="price_1" step="0.01">
                </div>
                <div>
                    <input type="number" placeholder="Enter price (Higher)" id="price_2" step="0.01">
                </div>
                <div>
                    <select id="category_id">
                        <option value="">Select category</option>
                        <?php 
                            foreach($categories as $c){
                                print_r($c);
                                echo '<option value="'.$c["category_id"].'">'.$c["category_name"].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div>
                    <button type="button" id="search">Search</button>
                </div>
            </div>
        </div>

    </section>


    <!--Books-->

    <div class="books" style="margin-top: 30px;">
        <h1><u>Search Results</u></h1>
        <div class="search_placeholder" id="search_placeholder">
            <h3 class="text-muted" id="placeholder_txt">Search to display results.</h3>
        </div>
        <div class="books_box" id="books_box" style="display: none;">

        </div>
    </div>

    <!--Footer-->

    <?php include('web/views/footer.php') ?>
<script>
//---------------------------------------------------------------------------------------------------------------------
// when click on the search button
    const search_btn = document.getElementById('search');
    search_btn.addEventListener('click', function (event) {
        document.getElementById('books_box').style.display = 'none';
        document.getElementById('books_box').innerHTML = '';
        document.getElementById('placeholder_txt').innerHTML = 'Searching...';
        document.getElementById('search_placeholder').style.display = 'block';
        document.getElementById('search_placeholder').style.display = 'flex';
        let book_name = document.getElementById('book_name').value;
        let price_lower = document.getElementById('price_1').value;
        let price_upper = document.getElementById('price_2').value;
        let category_id = document.getElementById('category_id').value;
        get_books(book_name, price_lower, price_upper, category_id);
    });
//---------------------------------------------------------------------------------------------------------------------
// for book catelogue
async function get_books(book_name, price_lower, price_upper, category_id) {
    // Fetch the XML data
    const response = await fetch('/online_bookstore/books/books.xml?timestamp=<?=date('YmdHis')?>');
    const xmlString = await response.text();

    // Parse the XML data
    const parser = new DOMParser();
    const xmlDoc = parser.parseFromString(xmlString, 'text/xml');
    const books = Array.from(xmlDoc.querySelectorAll('book'));

    // Function to check if a book matches the search criteria
    function bookMatchesCriteria(book) {
        const bookName = book.querySelector('book_name').textContent.toLowerCase();
        const bookPrice = parseFloat(book.querySelector('price').textContent);
        const bookCategoryId = parseInt(book.querySelector('category_id').textContent);

        if (book_name && !bookName.includes(book_name.toLowerCase())) {
        return false;
        }

        if (price_lower && bookPrice < parseFloat(price_lower)) {
        return false;
        }

        if (price_upper && bookPrice > parseFloat(price_upper)) {
        return false;
        }

        if (category_id && bookCategoryId !== parseInt(category_id)) {
        return false;
        }

        return true;
    }

    // Filter the books based on the search criteria
    const filteredBooks = books.filter(bookMatchesCriteria);

    // Sort the filtered books based on c_date in descending order (most recent first)
    filteredBooks.sort((a, b) => {
        const dateA = new Date(a.querySelector('c_date').textContent);
        const dateB = new Date(b.querySelector('c_date').textContent);
        return dateB - dateA;
    });

    // Function to create a book card
    function createBookCard(book) {
        const bookCard = document.createElement('div');
        bookCard.classList.add('books_card');

        const bookImage = document.createElement('div');
        bookImage.classList.add('books_image');
        const imageSrc = book.querySelector('book_id').textContent + '.jpg';
        bookImage.innerHTML = `<img src="/online_bookstore/books/image/${imageSrc}">`;
        let discounted_price = parseFloat(parseFloat(book.querySelector('price').textContent) - parseFloat(book.querySelector('discount').textContent)).toFixed(2);
        const bookDetails = document.createElement('div');
        bookDetails.classList.add('book_card_details');
        if(parseFloat(book.querySelector('discount').textContent) > 0){
            bookDetails.innerHTML = `
            <h2>${book.querySelector('book_name').textContent}</h2>
            <p class="writer">${book.querySelector('author').textContent}</p>
            <div class="categories">${book.querySelector('category_name').textContent}</div>
            <p class="book_price"><del>$${book.querySelector('price').textContent}</del> <span class="discounted_price">$${discounted_price}</span></p>
            <a href="/online_bookstore?page=View_book&book_id=${book.querySelector('book_id').textContent}" class="f_btn">View More</a>
            `;
        }else{
            bookDetails.innerHTML = `
            <h2>${book.querySelector('book_name').textContent}</h2>
            <p class="writer">${book.querySelector('author').textContent}</p>
            <div class="categories">${book.querySelector('category_name').textContent}</div>
            <p class="book_price">$${book.querySelector('price').textContent}</p>
            <a href="/online_bookstore?page=View_book&book_id=${book.querySelector('book_id').textContent}" class="f_btn">View More</a>
            `;
        }

        bookCard.appendChild(bookImage);
        bookCard.appendChild(bookDetails);

        return bookCard;
    }

    // Get the "books_box" element
    const booksBox = document.querySelector('.books_box');
    const placeholderTxt = document.getElementById('placeholder_txt');
    const search_placeholder = document.getElementById('search_placeholder');

    // Show/hide elements based on search results
    if (filteredBooks.length > 0) {
        booksBox.innerHTML = ''; // Clear existing books before adding new ones

        // Loop through each book and append its card to the "books_box"
        for (const book of filteredBooks) {
        const bookCard = createBookCard(book);
            if (bookCard) {
                booksBox.appendChild(bookCard);
            }
        }

        booksBox.style.display = 'block'; // Show the "books_box" element
        booksBox.style.display = 'flex'; // Show the "books_box" element
        search_placeholder.style.display = 'none'; // Hide the "placeholder_txt" element
    } else {
        booksBox.style.display = 'none'; // Hide the "books_box" element
        placeholderTxt.textContent = 'No results found!!!'; // Change the text content
    }
}

//---------------------------------------------------------------------------------------------------------------------
</script>       

</body>
</html>