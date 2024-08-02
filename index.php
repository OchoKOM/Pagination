<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infinite Scroll Pagination</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Infinite Scroll</h1>
        <div id="product-list"></div>
        <div id="loader" style="display: none;">
            <svg class="loader" viewBox="25 25 50 50" stroke-width="5">
                <circle cx="50" cy="50" r="20"></circle>
            </svg>
        </div>
        <div id="end-of-content">
            <p class="message">There's no more product to load</p>
            <button class="refresh-button">Refresh</button>
        </div>
        <div id="error-message">
            <p class="message">Failed to load products. </p>
            <button class="retry-button">Retry</button>
        </div>
    </div>
    <script src="./app.js"></script>
</body>

</html>