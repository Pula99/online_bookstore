<?php

class Books_m{
//-----------------------------------------------------------
// for get categories
    public function get_categories(){
        //databae connection
        require('config/db_config.php');

        $categories = array();
        $query = "SELECT * FROM categories";
        $result = mysqli_query($con, $query);

        if($result){
            while ($row = mysqli_fetch_assoc($result)) {
                $categories[] = $row;
            }
            mysqli_free_result($result);
        }

        return $categories;
        $con->close();
    }
//-----------------------------------------------------------
// to add a category
    public function add_category(){
        //databae connection
        require('config/db_config.php');

        //validations
        $errors = "";
        if(empty($_POST['new_category'])){
            $errors .= "Category name is required.\n";
        }

        $category_name = mysqli_real_escape_string($con, $_POST['new_category']);
        $query = "SELECT category_id FROM categories WHERE category_name = '".trim($category_name)."'";
        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result) > 0){
            $errors .= "Category already exists.\n";
        }

        if(!empty($errors)){
            return array("status" => "error", "msg" => $errors);
        }else{
            // Insert the new category into the database
            $insert_query = "INSERT INTO categories (category_name) VALUES ('$category_name')";
            $insert_result = mysqli_query($con, $insert_query);
        
            if($insert_result){
                return array("status" => "success", "msg" => "Category added successfully.");
            }else{
                return array("status" => "error", "msg" => "Something went wrong...");
            }
        }

        $con->close();
    }
//-----------------------------------------------------------
// to add a book
    public function add_book() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // Database connection
        require('config/db_config.php');

        // Validations
        $errors = [];

        if (empty($_POST['book_name'])) {
            $errors[] = "Book name is required.";
        }

        if (empty($_POST['author'])) {
            $errors[] = "Author is required.";
        }

        if (empty($_POST['category_id'])) {
            $errors[] = "Category is required.";
        }

        if (empty($_POST['isbn_no'])) {
            $errors[] = "ISBN Number is required.";
        }

        if (empty($_POST['price'])) {
            $errors[] = "Price is required.";
        }

        // Validate image and PDF file sizes and extensions
        if ($_FILES['book_photo']['size'] > 5 * 1024 * 1024) { // 5 MB
            $errors[] = "Book photo size must be less than 5 MB.";
        }

        if ($_FILES['book_pdf']['size'] > 10 * 1024 * 1024) { // 10 MB
            $errors[] = "Book PDF size must be less than 10 MB.";
        }

        $allowed_image_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $allowed_pdf_extensions = ['pdf'];

        $book_photo_extension = strtolower(pathinfo($_FILES['book_photo']['name'], PATHINFO_EXTENSION));
        $book_pdf_extension = strtolower(pathinfo($_FILES['book_pdf']['name'], PATHINFO_EXTENSION));

        if (!in_array($book_photo_extension, $allowed_image_extensions)) {
            $errors[] = "Invalid image file extension. Allowed extensions: jpg, jpeg, png, gif.";
        }

        if (!in_array($book_pdf_extension, $allowed_pdf_extensions)) {
            $errors[] = "Invalid PDF file extension. Allowed extension: pdf.";
        }

        if (!empty($errors)) {
            return array("status" => "error", "msg" => implode("\n", $errors));
        } else {
            // Sanitize and escape form data to prevent SQL injection
            $book_name = mysqli_real_escape_string($con, $_POST['book_name']);
            $author = mysqli_real_escape_string($con, $_POST['author']);
            $publisher = mysqli_real_escape_string($con, $_POST['publisher']);
            $category_id = mysqli_real_escape_string($con, $_POST['category_id']);
            $isbn_no = mysqli_real_escape_string($con, $_POST['isbn_no']);
            $price = mysqli_real_escape_string($con, $_POST['price']);
            $discount = mysqli_real_escape_string($con, $_POST['discount']);
            $handled_by = $_SESSION["user_id"];

            if(empty($_POST["book_id"])){
                // Insert the book details into the database
                $insert_query = "INSERT INTO books (book_name, author, publisher, category_id, isbn_no, price, discount, handled_by) 
                                VALUES ('$book_name', '$author', '$publisher', '$category_id', '$isbn_no', '$price', '$discount', '$handled_by')";
                $insert_result = mysqli_query($con, $insert_query);
                $exec_result = $insert_result;
            }else{
                //update the database table
                $book_id = $_POST["book_id"];
                $update_query = "UPDATE books SET 
                            book_name = '$book_name', 
                            author = '$author', 
                            publisher = '$publisher', 
                            category_id = '$category_id', 
                            isbn_no = '$isbn_no', 
                            price = '$price', 
                            discount = '$discount', 
                            handled_by = '$handled_by' 
                            WHERE book_id = '$book_id'";
                $update_result = mysqli_query($con, $update_query);
                $exec_result = $update_result;
            }

            if ($exec_result) {
                // Get the newly inserted book id
                $book_id = mysqli_insert_id($con);

                // to create the xml file
                $this->getBooksAsXml($con);

                // Rename and move the book photo to the appropriate folder
                $book_photo_filename = $book_id . "." . $book_photo_extension;
                move_uploaded_file($_FILES['book_photo']['tmp_name'], "C:/xampp/htdocs/online_bookstore/books/image/" . $book_photo_filename);

                // Rename and move the book PDF to the appropriate folder
                $book_pdf_filename = $book_id . "." . $book_pdf_extension;
                move_uploaded_file($_FILES['book_pdf']['tmp_name'], "C:/xampp/htdocs/online_bookstore/books/pdf/" . $book_pdf_filename);

                return array("status" => "success", "msg" => "Book added successfully.");
            } else {
                return array("status" => "error", "msg" => "Something went wrong...");
            }
        }

        $con->close();
    }
//-----------------------------------------------------------
    public function getBooksAsXml($con)
    {
        $query = "SELECT b.*, c.category_name, u.first_name handled_user FROM books b 
                    LEFT JOIN categories c ON b.category_id = c.category_id 
                    LEFT JOIN bookstore_user u ON b.handled_by = u.user_id 
                    WHERE b.status = 'active'";
        $result = mysqli_query($con, $query);

        if (!$result) {
            return 0;
        }

        $xml = new SimpleXMLElement('<books/>');
        while ($row = mysqli_fetch_assoc($result)) {
            $book = $xml->addChild('book');
            foreach ($row as $key => $value) {
                $book->addChild($key, htmlspecialchars($value));
            }
        }

        mysqli_free_result($result);
        $xmlData = $xml->asXML();

        // Format the XML with indentation
        $doc = new DOMDocument('1.0');
        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = true;
        $doc->loadXML($xmlData);
        $formattedXmlData = $doc->saveXML();

        // Save the formatted XML to the file
        file_put_contents('C:/xampp/htdocs/online_bookstore/books/books.xml', $formattedXmlData);
        return 1;
    }
//-----------------------------------------------------------
// delete book
    public function delete_books($book_id) 
    {
        // Database connection
        require('config/db_config.php');

        // Check if the book exists in the database
        $query = "SELECT * FROM books WHERE book_id = '$book_id'";
        $result = mysqli_query($con, $query);

        if (!$result || mysqli_num_rows($result) == 0) {
            return array("status" => "error", "msg" => "Book not found.");
        }

        // Delete the book from the database
        $delete_query = "DELETE FROM books WHERE book_id = '$book_id'";
        $delete_result = mysqli_query($con, $delete_query);

        if ($delete_result) {
            // Delete the associated book photo and book PDF files (if they exist)
            $book_photo_path = "C:/xampp/htdocs/online_bookstore/books/image/" . $book_id . ".jpg"; // Change the file extension as needed
            $book_pdf_path = "C:/xampp/htdocs/online_bookstore/books/pdf/" . $book_id . ".pdf"; // Change the file extension as needed

            if (file_exists($book_photo_path)) {
                unlink($book_photo_path); // Delete the book photo file
            }

            if (file_exists($book_pdf_path)) {
                unlink($book_pdf_path); // Delete the book PDF file
            }

            // Update the XML file after deletion
            $this->getBooksAsXml($con);

            return array("status" => "success", "msg" => "Book deleted successfully.");
        } else {
            return array("status" => "error", "msg" => "Failed to delete book.");
        }

        $con->close();
    }
//-----------------------------------------------------------
// get book by id
    public function get_book_by_id($book_id) {
        // Database connection
        require('config/db_config.php');

        // Sanitize and escape the book_id to prevent SQL injection
        $book_id = mysqli_real_escape_string($con, $book_id);

        // Query to get the book by book_id
        $query = "SELECT * FROM books WHERE book_id = '$book_id' LIMIT 1";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $book = mysqli_fetch_assoc($result);
            mysqli_free_result($result);
            return $book;
        } else {
            return false; // Book not found
        }

        $con->close();
    }
//-----------------------------------------------------------
}

?>