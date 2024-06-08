<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .container {
        width: 100%;
        max-width: 500px; /* Wider container */
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    h1, h2 {
        color: #333;
        text-align: center;
    }

    form label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }

    select, input[type="number"] {
        width: calc(100% - 10px); /* Adjusted width */
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .dish-entry {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
    }

    .dish-entry select, .dish-entry input[type="number"] {
        flex: 1;
    }

    .dish-entry button {
        background-color: #ff5722;
        color: white;
        border: none;
        border-radius: 4px;
        padding: 8px 12px;
        cursor: pointer;
    }

    .dish-entry button:hover {
        background-color: #e64a19;
    }

    .button-container {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .button-container button {
        width: 48%;
        padding: 10px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .button-container button:hover {
        background-color: #45a049;
    }

    .button-container button[type="button"] {
        background-color: #f44336;
        color: white;
    }

    .button-container button[type="button"]:hover {
        background-color: #d32f2f;
    }

    ul {
        padding: 0;
        list-style: none;
    }

    ul li {
        margin-bottom: 10px;
    }

    .review-section {
        display: flex;
        flex-direction: column;
        gap: 15px;
        margin-bottom: 20px;
    }

    .review-item {
        display: flex;
        /* justify-content: space-between; */
    }

    .review-item h2, .review-item p {
        margin: 0;
        width: 50%;
    }

    .review-item h2 {
        font-size: 16px;
        color: #555;
    }

    .review-item p {
        font-size: 16px;
        color: #333;
    }
</style>
