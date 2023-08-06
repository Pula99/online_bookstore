<?php

class Books{
//-----------------------------------------------------------
// add book page
    public function add_books() {
        include('admin/views/head.php');
        include('admin/views/add_books.php');
        include('admin/views/foot.php');
    }
//-----------------------------------------------------------
//-----------------------------------------------------------
// update books
    public function Update_books() {
        include('admin/views/head.php');
        include('admin/views/add_books.php');
        include('admin/views/foot.php');
    }
//-----------------------------------------------------------
// view books page
    public function view_books() {
        include('admin/views/head.php');
        include('admin/views/view_books.php');
        include('admin/views/foot.php');
    }
//-----------------------------------------------------------
// to get categories
    public function get_categories() 
    {
        include('models/Books_m.php');
        $books = new Books_m();
        $re = $books->get_categories();
        echo json_encode($re);
    }
//-----------------------------------------------------------
// to add category
    public function add_category() 
    {
        include('models/Books_m.php');
        $books = new Books_m();
        $re = $books->add_category();
        echo json_encode($re);
    }
//-----------------------------------------------------------
// to add a book
    public function add_book() 
    {
        include('models/Books_m.php');
        $books = new Books_m();
        $re = $books->add_book();
        echo json_encode($re);
    }
//-----------------------------------------------------------
// to delete book
    public function delete_books($book_id) 
    {
        include('models/Books_m.php');
        $books = new Books_m();
        $re = $books->delete_books($book_id);
        echo json_encode($re);
    }
//-----------------------------------------------------------
// to get book
    public function get_book_by_id($book_id) 
    {
        include('models/Books_m.php');
        $books = new Books_m();
        $re = $books->get_book_by_id($book_id);
        echo json_encode($re);
    }
//-----------------------------------------------------------
}

?>