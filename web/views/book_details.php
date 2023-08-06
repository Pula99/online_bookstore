<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details</title>
    <link rel="stylesheet" href="web/assets/css/book_detail_styles.css">
</head>
<body>

<div class="book-details-container">
    <div class="book-details">
        <div class="book-image">
            <img src="" alt="Book Cover">
        </div>
        <div class="book-info">
            <h1 class="book-title">Book Title</h1>
            <p class="book-author">Author: </p>
            <p class="book-category">Category: </p>
            <p class="book-isbn">ISBN: </p>
            <p class="book-price">Price: </p>
            <a class="download-pdf-btn" href="#" download>Download PDF</a>
        </div>
    </div>
    <p class="no-results-text">No results found!!!</p>
</div>

<script>
    // Function to get the query parameter from the URL
    function getParameterByName(name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, '\\$&');
        var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, ' '));
    }

    // Fetch the XML data
    fetch('/online_bookstore/books/books.xml?timestamp=<?=date('YmdHis')?>')
    .then(response => response.text())
    .then(xmlString => {
        // Parse the XML data
        const parser = new DOMParser();
        const xmlDoc = parser.parseFromString(xmlString, 'text/xml');
        const books = xmlDoc.querySelectorAll('book');

        // Get the book_id from the URL query parameter
        const bookIdParam = getParameterByName('book_id');
        const bookId = parseInt(bookIdParam);

        // Function to create a book card
        function createBookDetails(book) {
            const bookDetails = document.querySelector('.book-details');
            bookDetails.querySelector('.book-title').textContent = book.querySelector('book_name').textContent;
            bookDetails.querySelector('.book-author').textContent = `Author: ${book.querySelector('author').textContent}`;
            bookDetails.querySelector('.book-category').textContent = `Category: ${book.querySelector('category_name').textContent}`;
            bookDetails.querySelector('.book-isbn').textContent = `ISBN: ${book.querySelector('isbn_no').textContent}`;
            let bookPrice = bookDetails.querySelector('.book-price');
            bookDetails.querySelector('.book-image img').src = `/online_bookstore/books/image/${book.querySelector('book_id').textContent}.jpg`;

            const price = parseFloat(book.querySelector('price').textContent);
            const discount = parseFloat(book.querySelector('discount').textContent);
            if (discount > 0) {
                const discountedPrice = (price - discount).toFixed(2);
                bookPrice.innerHTML = `Price: <del>$${price.toFixed(2)}</del> <span class="discounted-price">$${discountedPrice}</span>`;
            } else {
                bookPrice.textContent = "Price: $" + price.toFixed(2);
            }

            // Set the link for downloading the PDF (change "your_pdf_filename.pdf" to the actual PDF filename)
            const downloadPdfBtn = bookDetails.querySelector('.download-pdf-btn');
            downloadPdfBtn.href = `/online_bookstore/books/pdf/${book.querySelector('book_id').textContent}.pdf`;
        }

        // Find the book with the matching book_id
        for (const book of books) {
            const bookIdFromXML = parseInt(book.querySelector('book_id').textContent);
            if (bookIdFromXML === bookId) {
                createBookDetails(book);
                break;
            }
        }
    })
    .catch(error => {
        console.error('Error fetching or parsing XML:', error);
    });
</script>
</body>
</html>
