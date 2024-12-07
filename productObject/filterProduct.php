<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Listing</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .container {
            display: grid;
            grid-template-columns: repeat(auto-fit, 240px);
            /* Fixed size of 250px for each product */
            gap: 20px;
        }


        .product {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .product img {
            width: 200px;
            height: auto;
            display: block;
        }

        .product-details {
            padding: 15px;
        }

        .product-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .product-reviews {
            font-size: 14px;
            color: #999;
            margin-bottom: 10px;
        }

        .product-price {
            font-size: 16px;
            font-weight: bold;
            color: #27ae60;
            margin-bottom: 10px;
        }

        .product-prev-price {
            font-size: 14px;
            color: #e74c3c;
            text-decoration: line-through;
            margin-right: 10px;
        }

        .product-company,
        .product-color,
        .product-category {
            font-size: 14px;
            color: #555;
        }

        .filter-input {
            margin-bottom: 20px;
            padding: 10px;
            width: 100%;
            max-width: 300px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <h1>Product Listing</h1>

    <!-- Filter input box -->
    <input type="text" id="filterInput" class="filter-input" placeholder="Search products..." onkeyup="filterProducts()">

    <div class="container" id="productContainer">
        <?php
        $data = [
            [
                "img" => "https://m.media-amazon.com/images/I/6125yAfsJKL._AC_UX575_.jpg",
                "title" => "Nike Air Monarch IV",
                "reviews" => "(123 reviews)",
                "prevPrice" => "$140,00",
                "newPrice" => "200",
                "company" => "Nike",
                "color" => "white",
                "category" => "sneakers",
            ],
            // Add other products here as per your dataset

            [
                "img" => "https://m.media-amazon.com/images/I/6125yAfsJKL._AC_UX575_.jpg",
                "title" => "Nike Air Monarch IV",
                "reviews" => "(123 reviews)",
                "prevPrice" => "$140,00",
                "newPrice" => "200",
                "company" => "Nike",
                "color" => "white",
                "category" => "sneakers",
            ],
            [
                "img" => "https://m.media-amazon.com/images/I/519MRhRKGFL._AC_UX575_.jpg",
                "title" => "Nike Air Vapormax Plus",
                "reviews" => "(123 reviews)",
                "prevPrice" => "$140,00",
                "newPrice" => "200",
                "company" => "Nike",
                "color" => "red",
                "category" => "sneakers",
            ],
            [
                "img" => "https://m.media-amazon.com/images/I/51+P9uAvb1L._AC_UY695_.jpg",
                "title" => "Nike Waffle One Sneaker",
                "reviews" => "(123 reviews)",
                "prevPrice" => "$140,00",
                "newPrice" => "200",
                "company" => "Nike",
                "color" => "green",
                "category" => "sneakers",
            ],
            [
                "img" => "https://m.media-amazon.com/images/I/71oEKkghg-L._AC_UX575_.jpg",
                "title" => "Nike Running Shoe",
                "reviews" => "(123 reviews)",
                "prevPrice" => "$140,00",
                "newPrice" => "200",
                "company" => "Adidas",
                "color" => "black",
                "category" => "sneakers",
            ],
            [
                "img" => "https://m.media-amazon.com/images/I/41M54ztS6IL._AC_SY625._SX._UX._SY._UY_.jpg",
                "title" => "Flat Slip On Pumps",
                "reviews" => "(123 reviews)",
                "prevPrice" => "$140,00",
                "newPrice" => "200",
                "company" => "Vans",
                "color" => "green",
                "category" => "flats",
            ],
            [
                "img" => "https://m.media-amazon.com/images/I/71zKuNICJAL._AC_UX625_.jpg",
                "title" => "Knit Ballet Flat",
                "reviews" => "(123 reviews)",
                "prevPrice" => "$140,00",
                "newPrice" => "50",
                "company" => "Adidas",
                "color" => "black",
                "category" => "flats",
            ],
            [
                "img" => "https://m.media-amazon.com/images/I/61V9APfz97L._AC_UY695_.jpg",
                "title" => "Loafer Flats",
                "reviews" => "(123 reviews)",
                "prevPrice" => "$140,00",
                "newPrice" => "50",
                "company" => "Vans",
                "color" => "white",
                "category" => "flats",
            ],
            [
                "img" => "https://m.media-amazon.com/images/I/71VaQ+V6XnL._AC_UY695_.jpg",
                "title" => "Nike Zoom Freak",
                "reviews" => "(123 reviews)",
                "prevPrice" => "$140,00",
                "newPrice" => "200",
                "company" => "Nike",
                "color" => "green",
                "category" => "sneakers",
            ],
            [
                "img" => "https://m.media-amazon.com/images/I/61-cBsLhJHL._AC_UY695_.jpg",
                "title" => "Nike Men's Sneaker",
                "reviews" => "(123 reviews)",
                "prevPrice" => "$140,00",
                "newPrice" => "200",
                "company" => "Adidas",
                "color" => "blue",
                "category" => "sneakers",
            ],
            [
                "img" => "https://m.media-amazon.com/images/I/81xXDjojYKS._AC_UX575_.jpg",
                "title" => "PUMA BLACK-OCE",
                "reviews" => "(123 reviews)",
                "prevPrice" => "$140,00",
                "newPrice" => "150",
                "company" => "Puma",
                "color" => "green",
                "category" => "sneakers",
            ],
            [
                "img" => "https://m.media-amazon.com/images/I/71E75yRwCDL._AC_UY575_.jpg",
                "title" => "Pacer Future Sneaker",
                "reviews" => "(123 reviews)",
                "prevPrice" => "$140,00",
                "newPrice" => "150",
                "company" => "Puma",
                "color" => "red",
                "category" => "sneakers",
            ],
            [
                "img" => "https://m.media-amazon.com/images/I/71jeoX0rMBL._AC_UX575_.jpg",
                "title" => "Unisex-Adult Super",
                "reviews" => "(123 reviews)",
                "prevPrice" => "$140,00",
                "newPrice" => "150",
                "company" => "Puma",
                "color" => "black",
                "category" => "sneakers",
            ],
            [
                "img" => "https://m.media-amazon.com/images/I/61TM6Q9dvxL._AC_UX575_.jpg",
                "title" => "Roma Basic Sneaker",
                "reviews" => "(123 reviews)",
                "prevPrice" => "$140,00",
                "newPrice" => "150",
                "company" => "Puma",
                "color" => "white",
                "category" => "sneakers",
            ],
            [
                "img" => "https://m.media-amazon.com/images/I/7128-af7joL._AC_UY575_.jpg",
                "title" => "Pacer Future Doubleknit",
                "reviews" => "(123 reviews)",
                "prevPrice" => "$140,00",
                "newPrice" => "150",
                "company" => "Puma",
                "color" => "black",
                "category" => "sneakers",
            ],
            [
                "img" => "https://m.media-amazon.com/images/I/81xXDjojYKS._AC_UX575_.jpg",
                "title" => "Fusion Evo Golf Shoe",
                "reviews" => "(123 reviews)",
                "prevPrice" => "$140,00",
                "newPrice" => "100",
                "company" => "Puma",
                "color" => "green",
                "category" => "sneakers",
            ],
            [
                "img" => "https://m.media-amazon.com/images/I/719gdz8lsTS._AC_UX575_.jpg",
                "title" => "Rainbow Chex Skate",
                "reviews" => "(123 reviews)",
                "prevPrice" => "$140,00",
                "newPrice" => "100",
                "company" => "Vans",
                "color" => "red",
                "category" => "flats",
            ],
            [
                "img" => "https://m.media-amazon.com/images/I/71gpFHJlnoL._AC_UX575_.jpg",
                "title" => "Low-Top Trainers",
                "reviews" => "(123 reviews)",
                "prevPrice" => "$140,00",
                "newPrice" => "100",
                "company" => "Vans",
                "color" => "white",
                "category" => "sandals",
            ],
            [
                "img" => "https://m.media-amazon.com/images/I/71pf7VFs9CL._AC_UX575_.jpg",
                "title" => "Vans Unisex Low-Top",
                "reviews" => "(123 reviews)",
                "prevPrice" => "$140,00",
                "newPrice" => "100",
                "company" => "Vans",
                "color" => "blue",
                "category" => "sandals",
            ],
            [
                "img" => "https://m.media-amazon.com/images/I/61N4GyWcHPL._AC_UY575_.jpg",
                "title" => "Classic Bandana Sneakers",
                "reviews" => "(123 reviews)",
                "prevPrice" => "$140,00",
                "newPrice" => "50",
                "company" => "Nike",
                "color" => "black",
                "category" => "sandals",
            ],
        ];

        foreach ($data as $product) {
            echo '<div class="product" data-title="' . strtolower($product['title']) . '">';
            echo '<img src="' . $product['img'] . '" alt="' . htmlspecialchars($product['title']) . '">';
            echo '<div class="product-details">';
            echo '<div class="product-title">' . htmlspecialchars($product['title']) . '</div>';
            echo '<div class="product-reviews">' . htmlspecialchars($product['reviews']) . '</div>';
            echo '<div class="product-price">';
            echo '<span class="product-prev-price">' . htmlspecialchars($product['prevPrice']) . '</span>';
            echo htmlspecialchars($product['newPrice']);
            echo '</div>';
            echo '<div class="product-company"><strong>Company:</strong> ' . htmlspecialchars($product['company']) . '</div>';
            echo '<div class="product-color"><strong>Color:</strong> ' . htmlspecialchars($product['color']) . '</div>';
            echo '<div class="product-category"><strong>Category:</strong> ' . htmlspecialchars($product['category']) . '</div>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>

    <script>
        // JavaScript to filter products based on input text
        function filterProducts() {
            var input = document.getElementById('filterInput');
            var filter = input.value.toLowerCase();
            var products = document.getElementsByClassName('product');

            for (var i = 0; i < products.length; i++) {
                var product = products[i];
                var title = product.getAttribute('data-title');

                if (title.indexOf(filter) > -1) {
                    product.style.display = "";
                } else {
                    product.style.display = "none";
                }
            }
        }
    </script>
</body>

</html>