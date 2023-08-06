<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Online Book Store</title>
    <link rel="stylesheet" href="web/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <section>
        <?php include('web/views/nav.php') ?>
        <div class="discounted-banner">
            <div class="banner-content">
            </div>
        </div>
    </section>


    <!--Books-->

    <div class="books" style="margin-top: 30px;">
        <h1>Discounted Books</h1>
        <div class="books_box">

        </div>

    </div>

    <!--Footer-->

    <?php include('web/views/footer.php') ?>

<script>
//---------------------------------------------------------------------------------------------------------------------
// for discounted books
    get_books();
    function get_books(){
        fetch('/online_bookstore/books/books.xml?timestamp=<?=date('YmdHis')?>')
        .then(response => response.text())
        .then(xmlString => {
            // Parse the XML data
            const parser = new DOMParser();
            const xmlDoc = parser.parseFromString(xmlString, 'text/xml');
            const books = xmlDoc.querySelectorAll('book');

            // Function to create a book card
            function createBookCard(book) {
                const bookCard = document.createElement('div');
                bookCard.classList.add('books_card');

                const discountedPrice = parseFloat(parseFloat(book.querySelector('price').textContent) - parseFloat(book.querySelector('discount').textContent)).toFixed(2);

                if (parseFloat(book.querySelector('discount').textContent) > 0) {
                    const bookImage = document.createElement('div');
                    bookImage.classList.add('books_image');
                    const imageSrc = book.querySelector('book_id').textContent + '.jpg';
                    bookImage.innerHTML = `<img src="/online_bookstore/books/image/${imageSrc}">`;

                    const bookDetails = document.createElement('div');
                    bookDetails.classList.add('book_card_details');
                    bookDetails.innerHTML = `
                    <h2>${book.querySelector('book_name').textContent}</h2>
                    <p class="writer">${book.querySelector('author').textContent}</p>
                    <div class="categories">${book.querySelector('category_name').textContent}</div>
                    <p class="book_price">
                        <del>$${book.querySelector('price').textContent}</del> 
                        <span class="discounted_price">$${discountedPrice}</span>
                    </p>
                    <a href="/online_bookstore?page=View_book&book_id=${book.querySelector('book_id').textContent}" class="f_btn">View More</a>
                    `;

                    bookCard.appendChild(bookImage);
                    bookCard.appendChild(bookDetails);

                    return bookCard;
                }
            }

            // Get the "books_box" element
            const booksBox = document.querySelector('.books_box');

            // Loop through each book and append its card to the "books_box"
            for (const book of books) {
                const bookCard = createBookCard(book);
                if (bookCard) {
                    booksBox.appendChild(bookCard);
                }
            }
        })
        .catch(error => {
            console.error('Error fetching or parsing XML:', error);
        });
    }
//---------------------------------------------------------------------------------------------------------------------
</script>

</body>
</html>