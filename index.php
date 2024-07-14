<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Stock Market</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Global Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 960px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header */
        header {
            background-color: #333;
            color: #fff;
            padding: 1rem 0;
            text-align: center;
        }

        /* Navigation */
        nav {
            background-color: #444;
            text-align: center;
            margin-bottom: 20px;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        nav ul li {
            display: inline-block;
            margin-right: 10px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            padding: 0.5rem 1rem;
        }

        nav ul li a:hover {
            background-color: #555;
        }

        /* Chart Styles */
        .chart-container {
            width: 80%;
            margin: 20px auto;
        }

        /* Slideshow Styles */
        .slideshow-container {
            max-width: 100%;
            margin: 20px auto;
            position: relative;
            overflow: hidden;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .mySlides {
            display: none;
            width: 100%;
            position: relative;
        }

        .fade {
            -webkit-animation-name: fade;
            -webkit-animation-duration: 1.5s;
            animation-name: fade;
            animation-duration: 1.5s;
        }

        @-webkit-keyframes fade {
            from {opacity: 0}
            to {opacity: 1}
        }

        @keyframes fade {
            from {opacity: 0}
            to {opacity: 1}
        }

        /* Caption text */
        .text {
            color: #fff;
            font-size: 20px;
            padding: 8px 12px;
            position: absolute;
            bottom: 20px;
            width: 100%;
            text-align: center;
            background-color: rgba(0, 0, 0, 0.5);
            text-shadow: 2px 2px 4px #000;
        }

        /* Previous and Next buttons */
        .prev, .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            margin-top: -30px;
            padding: 16px;
            color: white;
            font-weight: bold;
            font-size: 20px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
        }

        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        .prev:hover, .next:hover {
            background-color: rgba(0,0,0,0.8);
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to Stock Market</h1>
        <nav>
            <ul>
                <li><a href="index.php">Stocks</a></li>
                <li><a href="transactions.php">Transactions</a></li>
                <li><a href="watchlist.php">Watchlist</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <!-- Chart -->
    <div class="chart-container">
        <canvas id="stockChart"></canvas>
    </div>

    <!-- Script for Chart -->
    <script>
        const ctx = document.getElementById('stockChart').getContext('2d');
        const stockChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'Stock Prices',
                    data: [65, 59, 80, 81, 56, 55, 40],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <!-- Slideshow -->
    <div class="slideshow-container">
        <!-- Slide 1 -->
        <div class="mySlides fade">
            <img src="s1.jpg" style="width:100%">
            <div class="text">Explore the Latest Stock Trends</div>
        </div>

        <!-- Slide 2 -->
        <div class="mySlides fade">
            <img src="s2.jpg" style="width:100%">
            <div class="text">Learn Effective Trading Strategies</div>
        </div>

        <!-- Slide 3 -->
        <div class="mySlides fade">
            <img src="s3.jpg" style="width:100%">
            <div class="text">Stay Informed with Market Analysis</div>
        </div>

        <!-- Previous and Next buttons -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>

    <!-- Script for Slideshow -->
    <script>
        let slideIndex = 0;
        showSlides();

        function showSlides() {
            let slides = document.getElementsByClassName("mySlides");
            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) {slideIndex = 1}
            slides[slideIndex - 1].style.display = "block";
            setTimeout(showSlides, 5000); // Change slide every 5 seconds
        }

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }
    </script>
</body>
</html>
