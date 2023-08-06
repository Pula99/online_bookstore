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

    <section class="home-banner">

        <?php include('web/views/nav.php') ?>

        <div class="main">

            <div class="main_tag">
                <h1>WELCOME TO<br><span>BOOK STORE</span></h1>

                <p>
                    Unlock Worlds, Embrace Stories: Welcome to Our Bookstore!
                </p>
                <a href="?page=ContactUs" class="main_btn">Learn More</a>

            </div>

            <div class="main_img">
                <img src="images/home_banner.png">
            </div>

        </div>

    </section>

    <!--New Arrival Books-->
    <div class="new_arrivals_boks">
        <h1>New Arrivals</h1>
        <div class="new_arrivals_book_box">
            <!-- <div class="new_arrivals_book_card">
                <div class="new_arrivals_book_img">
                    <img src="images/home/book_4.jpg">
                </div>
                <div class="new_arrivals_book_tag">
                    <h2>New Arrival Books</h2>
                    <p class="writer">John Deo</p>
                    <div class="categories">Thriller, Horror, Romance</div>
                    <p class="book_price">$25.50</p>
                    <a href="#" class="f_btn">Learn More</a>
                </div>
            </div>

            <div class="new_arrivals_book_card">
                <div class="card-overlay-nwar">
                    <a href="/online_bookstore?page=NewArrivals" class="view_more_nar">View More</a>
                </div>
                <div class="new_arrivals_book_img">
                    <img src="images/home/book_5.jpg">
                </div>
                <div class="new_arrivals_book_tag">
                    <h2>New Arrival Books</h2>
                    <p class="writer">John Deo</p>
                    <div class="categories">Thriller, Horror, Romance</div>
                    <p class="book_price">$25.50</p>
                    <a href="#" class="f_btn">Learn More</a>
                </div>
            </div> -->
        </div>
    </div>

    <!--Books-->
    <div class="books">
        <h1>Other Books</h1>
        <div class="books_box">
            <!-- <div class="books_card">
                <div class="books_image">
                    <img src="images/home/arrival_1.jpg">
                </div>
                <div class="book_card_details">
                    <h2>New Arrival Books</h2>
                    <p class="writer">John Deo</p>
                    <div class="categories">Thriller, Horror, Romance</div>
                    <p class="book_price">$25.50</p>
                    <a href="/online_bookstore?page=View_book&book_id=1" class="f_btn">Learn More</a>
                </div>
            </div> -->
        </div>
    </div>

    <!--Footer-->
    <?php include('web/views/footer.php') ?>


<script>
//---------------------------------------------------------------------------------------------------------------------
// for only for new arrivals
get_new_arrivals();
function get_new_arrivals(){
    fetch('/online_bookstore/books/books.xml?timestamp=<?=date('YmdHis')?>')
    .then(response => response.text())
    .then(xmlString => {
        // Parse the XML data
        const parser = new DOMParser();
        const xmlDoc = parser.parseFromString(xmlString, 'text/xml');
        const books = xmlDoc.querySelectorAll('book');

        // Function to create a new arrival book card
        function createNewArrivalBookCard(book) {
            const bookCard = document.createElement('div');
            bookCard.classList.add('new_arrivals_book_card');

            const bookImage = document.createElement('div');
            bookImage.classList.add('new_arrivals_book_img');
            const imageSrc = `${book.querySelector('book_id').textContent}.jpg`;
            bookImage.innerHTML = `<img src="/online_bookstore/books/image/${imageSrc}">`;

            let discounted_price = parseFloat(parseFloat(book.querySelector('price').textContent) - parseFloat(book.querySelector('discount').textContent)).toFixed(2);

            const bookTag = document.createElement('div');
            bookTag.classList.add('new_arrivals_book_tag');
            if(parseFloat(book.querySelector('discount').textContent) > 0){
                bookTag.innerHTML = `
                    <h2>${book.querySelector('book_name').textContent}</h2>
                    <p class="writer">${book.querySelector('author').textContent}</p>
                    <div class="categories">${book.querySelector('category_name').textContent}</div>
                    <p class="book_price"><del>$${book.querySelector('price').textContent}</del> <span class="discounted_price">$${discounted_price}</span></p>
                    <a href="/online_bookstore?page=View_book&book_id=${book.querySelector('book_id').textContent}" class="f_btn">View Book</a>
                `;
            }else{
                bookTag.innerHTML = `
                    <h2>${book.querySelector('book_name').textContent}</h2>
                    <p class="writer">${book.querySelector('author').textContent}</p>
                    <div class="categories">${book.querySelector('category_name').textContent}</div>
                    <p class="book_price">$${book.querySelector('price').textContent}</p>
                    <a href="/online_bookstore?page=View_book&book_id=${book.querySelector('book_id').textContent}" class="f_btn">View Book</a>
                `;
            }

            bookCard.appendChild(bookImage);
            bookCard.appendChild(bookTag);

            return bookCard;
        }

        // Get the "new_arrivals_book_box" element
        const newArrivalsBookBox = document.querySelector('.new_arrivals_book_box');

        // Sort the books by c_date in descending order
        const sortedBooks = [...books].sort((a, b) => {
            const dateA = new Date(a.querySelector('c_date').textContent);
            const dateB = new Date(b.querySelector('c_date').textContent);
            return dateB - dateA;
        });

        // Limit the number of new arrival books to 3
        const numNewArrivalsToShow = 4;
        for (let i = 0; i < numNewArrivalsToShow && i < sortedBooks.length; i++) {
            const bookCard = createNewArrivalBookCard(sortedBooks[i]);
            newArrivalsBookBox.appendChild(bookCard);
        }

        // Add the "View More" card for the last book
        if (sortedBooks.length > 0) {
            const lastBook = sortedBooks[0];
            const viewMoreCard = document.createElement('div');
            viewMoreCard.classList.add('new_arrivals_book_card');
            viewMoreCard.innerHTML = `
                <div class="card-overlay-nwar">
                <a href="/online_bookstore?page=NewArrivals" class="view_more_nar">View More</a>
                </div>
                <div class="new_arrivals_book_img">
                <img src="/online_bookstore/books/image/${lastBook.querySelector('book_id').textContent}.jpg">
                </div>
                <div class="new_arrivals_book_tag">
                <h2>${lastBook.querySelector('book_name').textContent}</h2>
                <p class="writer">${lastBook.querySelector('author').textContent}</p>
                <div class="categories">${lastBook.querySelector('category_name').textContent}</div>
                <p class="book_price">$${lastBook.querySelector('price').textContent}</p>
                <a href="/online_bookstore?page=View_book&book_id=${lastBook.querySelector('book_id').textContent}" class="f_btn">View Book</a>
                </div>
            `;
            newArrivalsBookBox.appendChild(viewMoreCard);
        }
    })
    .catch(error => {
        console.error('Error fetching or parsing XML:', error);
    });
}
//---------------------------------------------------------------------------------------------------------------------
// for other books
    get_books();
    function get_books(){
        // Fetch the XML data
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
                    <a href="/online_bookstore?page=View_book&book_id=${book.querySelector('book_id').textContent}" class="f_btn">View Book</a>
                    `;
                }else{
                    bookDetails.innerHTML = `
                    <h2>${book.querySelector('book_name').textContent}</h2>
                    <p class="writer">${book.querySelector('author').textContent}</p>
                    <div class="categories">${book.querySelector('category_name').textContent}</div>
                    <p class="book_price">$${book.querySelector('price').textContent}</p>
                    <a href="/online_bookstore?page=View_book&book_id=${book.querySelector('book_id').textContent}" class="f_btn">View Book</a>
                    `;
                }
    
                bookCard.appendChild(bookImage);
                bookCard.appendChild(bookDetails);
    
                return bookCard;
            }
    
            // Get the "books_box" element
            const booksBox = document.querySelector('.books_box');
    
            // Loop through each book and append its card to the "books_box"
            const numBooksToShow = 10;
            for (let i = 0; i < numBooksToShow && i < books.length; i++) {
                const bookCard = createBookCard(books[i]);
                booksBox.appendChild(bookCard);
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