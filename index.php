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
        <div id="loader" style="display: none;">Loading...</div>
        <div id="end-of-content" style="display: none;">All products loaded.</div>
        <div id="error-message" style="display: none;">
            <p class="message">Failed to load products. </p>
            <button class="retry-button">Retry</button>
        </div>
    </div>
    <script src="./app.js"></script>
</body>
</html>

