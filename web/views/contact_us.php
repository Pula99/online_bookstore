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

        <!--About-->

        <div class="about">

            <div class="about_image">
                <img src="images/about-us.png">
            </div>
            <div class="about_tag">
                <h1>About Us</h1>
                <p>
                    Welcome to our online bookstore! We love books, and we're here to bring the joy of reading to you.
                    Explore our wide selection of titles, find your next favorite read, and let the magic of literature transport you to new worlds. Happy reading!</p>

                <p>
                    our mission is to promote the joy of reading and celebrate the magic of books.
                    We strive to create an inclusive and immersive platform where literature thrives, fostering a love for reading in individuals of all ages and backgrounds.
                    With an unwavering commitment to quality and customer satisfaction, we aspire to be your go-to destination for all your literary needs.
                    Embark on a literary adventure with [Website Name] and unlock the doors to boundless worlds, extraordinary ideas, and endless imagination. Thank you for choosing us as your online bookstore, and happy reading!
                </p>

            </div>

        </div>

        <div id="map">
            <h1 style="font-size: 35px; margin-bottom: 35px;">Map to locate our store</h1>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.0517922580457!2d79.88134097574675!3d6.884399718862686!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2fc0237ed5d25%3A0x4c711f0161ac8139!2sThe%20Open%20University%20of%20Sri%20Lanka!5e0!3m2!1sen!2slk!4v1691306115420!5m2!1sen!2slk" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

    </section>
    <!--Footer-->

    <?php include('web/views/footer.php') ?>

</body>

</html>