<!DOCTYPE html>
<html lang="en">

<head>
    <title>DragonBall Store</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif; 
            background-image: url('img/goku.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            text-align: center;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            overflow: hidden;
            border-bottom: 1px solid #dee2e6;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        nav ul li {
            margin: 0 10px;
        }

        nav a {
            position: relative;
            font-size: 1.1em;
            color: #333;
            text-decoration: none;
            padding: 6px 20px;
            transition: .5s;
        }

        nav a:hover {
            color: #0ef;
        }

        nav a span {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            border-bottom: 2px solid #0ef;
            border-radius: 15px;
            transform: scale(0) translateY(50px);
            opacity: 0;
            transition: .5s;
        }

        nav a:hover span {
            transform: scale(1) translateY(0);
            opacity: 1;
        }

        .container {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 0 20px; 
            margin-bottom: 50px; 
        }


        article {
            margin-bottom: 30px; 
        }

        footer {
            padding: 20px;
            text-align: center;
            margin-top: auto;
            color: #131313;; 
        } 

        .social-media {
            margin-top: 20px;
        }

        .social-icon {
            font-size: 24px;
            margin: 0 10px;
            color: blueviolet;
            transition: transform 0.3s ease;
        }

        .social-icon:hover {
            transform: scale(1.2);
        }
        .mini-icons img {
            width: 150px; 
            height: auto;
            margin: 0 10px; 
            cursor: pointer; 
        }
    </style>
</head>

<body>

<nav>
    <ul>
        <li><a href="start.php">Home<span></span></a></li>
        <li><a href="products.php">Products<span></span></a></li>
        <li><a href="clients.php" class="active">Legendary Fans<span></span></a></li>
        <li><a href="orders.php">Orders<span></span></a></li>
        <li><a href="add_product.php">Add Product<span></span></a></li>
        <li><a href="add_customer.php">Add Legendary Fan<span></span></a></li>
        <li><a href="place_order.php">Create Battle Plan<span></span></a></li>
        <li style="float:right;"><a href="logout.php">Logout<span></span></a></li>
    </ul>
</nav>

<div class="container">
    <header>
        <h1 style="color: Orange;" >Welcome to DragonBall Store</h1> 
        <h3 style="color: purple;">Your One-Stop Shop for DragonBall Merchandise</h3>
    </header>

    <article style="color: red;">
        <p>Explore a wide range of high-quality DragonBall merchandise at DragonBall Store.</p>
        <p>From action figures to clothing, we have everything you need to dive into the world of DragonBall.</p>
        <p>Discover the perfect products for your collection and enjoy a seamless shopping experience.</p>
    </article>

    <audio id="song1">
    <source src="audio/dandan.mp3" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>

<audio id="song2">
    <source src="audio/dokkan.mp3" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>

<audio id="song3">
    <source src="audio/chalahead.mp3" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>

<audio id="song4">
    <source src="audio/og.mp3" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>

<audio id="song5">
    <source src="audio/survivor.mp3" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>

<div class="mini-icons">
    <img src="img/goku.png" alt="Icon 1" id="icon1">
    <img src="img/vegeta.png" alt="Icon 2" id="icon2">
    <img src="img/gohan.png" alt="Icon 3" id="icon3">
    <img src="img/piccolo.png" alt="Icon 4" id="icon4">
    <img src="img/krilin.png" alt="Icon 5" id="icon5">
</div>

<script>
    // Function to play theme song when clicking on the corresponding icon
    function playSong(songId) {
        const song = document.getElementById(songId);
        const allSongs = document.querySelectorAll('audio'); // Get all audio elements

        // Pause all songs except the one being played
        allSongs.forEach(function(audio) {
            if (audio.id !== songId) {
                audio.pause();
                audio.currentTime = 0;
            }
        });

        // Play or pause the clicked song
        if (song.paused) {
            song.play();
        } else {
            song.pause();
            song.currentTime = 0; // Reset song to beginning
        }
    }

    // Add click event listeners to each icon
    document.getElementById('icon1').addEventListener('click', function() {
        playSong('song1');
    });

    document.getElementById('icon2').addEventListener('click', function() {
        playSong('song2');
    });

    document.getElementById('icon3').addEventListener('click', function() {
        playSong('song3');
    });

    document.getElementById('icon4').addEventListener('click', function() {
        playSong('song4');
    });

    document.getElementById('icon5').addEventListener('click', function() {
        playSong('song5');
    });
</script>
</div>

<footer>
    <div class="social-media">
        <br><h3>Contact Us</h3>
        <a href="https://www.facebook.com/profile.php?id=100073473338451" target="_blank" class="social-icon">
            <i class="fab fa-facebook-square">Facebook</i>
        </a>
        <a href="https://www.instagram.com/_xlr8.kaysonv_" target="_blank" class="social-icon">
            <i class="fab fa-instagram">Instagram</i>
        </a>
        <a href="https://twitter.com/vudinhloc" target="_blank" class="social-icon">
            <i class="fab fa-twitter-square">Twitter</i>
        </a>
    </div>
    &copy; <?php echo date("Y"); ?> DragonBall Store
</footer>

</body>

</html>
