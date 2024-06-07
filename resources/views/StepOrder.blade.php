
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Multi-step Form</title>
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
            max-width: 400px;
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
            width: calc(100% - 10px);
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            width: 48%;
            background-color: #4CAF50;
            color: white;
            padding: 10px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        button[type="button"] {
            background-color: #f44336;
        }

        button[type="button"]:hover {
            background-color: #d32f2f;
        }

        ul {
            padding: 0;
            list-style: none;
        }

        ul li {
            margin-bottom: 10px;
        }
    </style>
</head>
<body onload="showStep(1)">
    <div id="step-1">
        <h1>Step 1: Select Meal Category and Number of People</h1>
        <form id="form-step-1" onsubmit="event.preventDefault(); showStep(2); saveStep1Data();">
            @csrf
            <label for="meal_category">Meal Category:</label>
            <select name="meal_category" id="meal_category" required>
                <option value="" selected>-- chọn--</option>
                @foreach ($meals as $meal)
                <option value="{{$meal->id}}">{{$meal->name}}</option>
                @endforeach
            </select><br><br>
            <label for="num_people">Number of People:</label>
            <input type="number" name="num_people" id="num_people" min="1" max="10" required><br><br>
            <button type="submit">Next</button>
        </form>
    </div>

    <div id="step-2" style="display: none;">
        <h1>Step 2: Select Restaurant</h1>
        <form id="form-step-2" onsubmit="event.preventDefault(); showStep(3); saveStep2Data();">
            @csrf
            <label for="restaurant">Restaurant:</label>
            <select name="restaurant" id="restaurant" required>

            </select><br><br>
            <button type="button" onclick="showStep(1); loadStep1Data();">Back</button>
            <button type="submit">Next</button>
        </form>
    </div>

    <div id="step-3" style="display: none;">
        <h1>Step 3: Select Dish and Portions</h1>
        <form id="form-step-3" onsubmit="event.preventDefault(); validateAndShowStep4();">
            @csrf
            <div id="dishes-container">
                <div class="dish-entry">
                    <label for="dish-1">Dish:</label>
                    <select name="dish[]" id="dish-1" class="dish-select" required>
                        <!-- Options will be dynamically populated -->
                    </select>
                    <label for="servings-1">Servings:</label>
                    <input type="number" name="servings[]" id="servings-1" class="servings-input" min="1" value="1" required>
                    <button type="button" onclick="removeDishEntry(this)">Remove</button>
                </div>
            </div>
            <button type="button" onclick="addDishEntry()">Add Dish</button><br><br>
            <button type="button" onclick="showStep(2); loadStep2Data();">Back</button>
            <button type="submit">Next</button>
        </form>
    </div>

    <div id="step-4" style="display: none;">
        <h1>Step 4: Review Your Information</h1>
        <div>
            <h2>Meal Category and Number of People</h2>
            <p id="summary-meal-category"></p>
            <p id="summary-num-people"></p>
        </div>
        <div>
            <h2>Selected Restaurant</h2>
            <p id="summary-restaurant"></p>
        </div>
        <div>
            <h2>Selected Dishes</h2>
            <ul id="summary-dishes"></ul>
        </div>
        <button type="button" onclick="showStep(3);">Back</button>
        <button type="button" onclick="submitFormData();">Submit</button>
    </div>
</body>
</html>

<script>
    function showStep(step) {
        document.getElementById('step-1').style.display = (step === 1) ? 'block' : 'none';
        document.getElementById('step-2').style.display = (step === 2) ? 'block' : 'none';
        document.getElementById('step-3').style.display = (step === 3) ? 'block' : 'none';
        document.getElementById('step-4').style.display = (step === 4) ? 'block' : 'none';

        if (step === 4) {
            loadSummaryData();
        }
    }

    function saveStep1Data() {
        const mealCategoryId = document.getElementById('meal_category').value;
        const mealCategoryName = document.getElementById('meal_category').options[document.getElementById('meal_category').selectedIndex].text;
        const numPeople = document.getElementById('num_people').value;

        localStorage.setItem('meal_category', JSON.stringify({ id: mealCategoryId, name: mealCategoryName }));
        localStorage.setItem('num_people', numPeople);

        fetch(`/get-restaurants/${mealCategoryId}`)
            .then(response => response.json())
            .then(data => {
                const restaurantDropdown = document.getElementById('restaurant');
                restaurantDropdown.innerHTML = '<option value="" selected>-- chọn--</option>';
                data.forEach(restaurant => {
                    const option = document.createElement('option');
                    option.value = restaurant.id;
                    option.innerText = restaurant.name;
                    restaurantDropdown.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function loadStep1Data() {
        const mealCategory = JSON.parse(localStorage.getItem('meal_category'));
        const numPeople = localStorage.getItem('num_people');

        if (mealCategory) {
            document.getElementById('meal_category').value = mealCategory.id;
        }
        if (numPeople) {
            document.getElementById('num_people').value = numPeople;
        }
    }

    function saveStep2Data() {
        const restaurantId = document.getElementById('restaurant').value;
        const restaurantName = document.getElementById('restaurant').options[document.getElementById('restaurant').selectedIndex].text;

        localStorage.setItem('restaurant', JSON.stringify({ id: restaurantId, name: restaurantName }));

        fetch(`/get-dishes/${restaurantId}`)
            .then(response => response.json())
            .then(data => {
                const dishDropdowns = document.getElementsByClassName('dish-select');
                for (let i = 0; i < dishDropdowns.length; i++) {
                    dishDropdowns[i].innerHTML = '<option value="" selected>-- chọn--</option>';
                    data.forEach(dish => {
                        const option = document.createElement('option');
                        option.value = dish.id;
                        option.innerText = dish.name;
                        dishDropdowns[i].appendChild(option);
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function loadStep2Data() {
        const restaurant = JSON.parse(localStorage.getItem('restaurant'));

        if (restaurant) {
            document.getElementById('restaurant').value = restaurant.id;
        }
    }

    function addDishEntry() {
        const dishContainer = document.getElementById('dishes-container');
        const dishEntries = dishContainer.getElementsByClassName('dish-entry').length;

        if (dishEntries >= 10) {
            alert('You can add a maximum of 10 dishes.');
            return;
        }

        const newDishEntry = document.createElement('div');
        newDishEntry.className = 'dish-entry';

        const dishId = `dish-${dishEntries + 1}`;
        const servingsId = `servings-${dishEntries + 1}`;

        newDishEntry.innerHTML = `
            <label for="${dishId}">Dish:</label>
            <select name="dish[]" id="${dishId}" class="dish-select" required>
                <!-- Options will be dynamically populated -->
            </select>
            <label for="${servingsId}">Servings:</label>
            <input type="number" name="servings[]" id="${servingsId}" class="servings-input" min="1" value="1" required>
            <button type="button" onclick="removeDishEntry(this)">Remove</button>
        `;

        dishContainer.appendChild(newDishEntry);

        const restaurantId = document.getElementById('restaurant').value;
        fetch(`/get-dishes/${restaurantId}`)
            .then(response => response.json())
            .then(data => {
                const dishDropdown = document.getElementById(dishId);
                dishDropdown.innerHTML = '<option value="" selected>-- chọn--</option>';
                data.forEach(dish => {
                    const option = document.createElement('option');
                    option.value = dish.id;
                    option.innerText = dish.name;
                    dishDropdown.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function removeDishEntry(button) {
        const dishContainer = document.getElementById('dishes-container');
        dishContainer.removeChild(button.parentNode);
    }

    function validateAndShowStep4() {
        const numPeople = parseInt(localStorage.getItem('num_people'), 10);
        const dishSelects = document.getElementsByClassName('dish-select');
        const servingsInputs = document.getElementsByClassName('servings-input');

        let totalDishes = 0;
        const selectedDishes = new Set();

        for (let i = 0; i < dishSelects.length; i++) {
            const dish = dishSelects[i].value;
            const servings = parseInt(servingsInputs[i].value, 10);

            if (selectedDishes.has(dish)) {
                alert('You cannot select the same dish more than once. Please add more servings to the existing dish.');
                return;
            }

            selectedDishes.add(dish);
            totalDishes += servings;
        }

        if (totalDishes < numPeople) {
            alert(`The total number of dishes (sum of servings) must be at least ${numPeople}.`);
            return;
        }

        if (dishSelects.length > 10) {
            alert('You can select a maximum of 10 dishes.');
            return;
        }

        saveStep3Data();
        showStep(4);
    }

    function saveStep3Data() {
        const dishSelects = document.getElementsByClassName('dish-select');

        const servingsInputs = document.getElementsByClassName('servings-input');

const dishes = [];
for (let i = 0; i < dishSelects.length; i++) {
    const dishId = dishSelects[i].value;
    const dishName = dishSelects[i].options[dishSelects[i].selectedIndex].text;
    const servings = servingsInputs[i].value;
    dishes.push({
        id: dishId,
        name: dishName,
        servings: servings
    });
}

localStorage.setItem('dishes', JSON.stringify(dishes));
}

function loadSummaryData() {
const mealCategory = JSON.parse(localStorage.getItem('meal_category'));
const numPeople = localStorage.getItem('num_people');
const restaurant = JSON.parse(localStorage.getItem('restaurant'));
const dishes = JSON.parse(localStorage.getItem('dishes'));

document.getElementById('summary-meal-category').innerText = 'Meal Category: ' + mealCategory.name;
document.getElementById('summary-num-people').innerText = 'Number of People: ' + numPeople;
document.getElementById('summary-restaurant').innerText = 'Restaurant: ' + restaurant.name;

const dishesList = document.getElementById('summary-dishes');
dishesList.innerHTML = '';

dishes.forEach(dish => {
    const listItem = document.createElement('li');
    listItem.innerText = `Dish: ${dish.name}, Servings: ${dish.servings}`;
    dishesList.appendChild(listItem);
});
}
</script>
<!-- Trong step1.blade.php -->
<script>
document.getElementById('meal_category').addEventListener('change', function() {
const mealId = this.value;

fetch(`/get-restaurants/${mealId}`)
    .then(response => response.json())
    .then(data => {
        const restaurantDropdown = document.getElementById('restaurant');
        restaurantDropdown.innerHTML = '<option value="" selected>-- chọn--</option>';
        data.forEach(restaurant => {
            const option = document.createElement('option');
            option.value = restaurant.id;
            option.innerText = restaurant.name;
            restaurantDropdown.appendChild(option);
        });
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

document.getElementById('restaurant').addEventListener('change', function() {
const restaurantId = this.value;

fetch(`/get-dishes/${restaurantId}`)
    .then(response => response.json())
    .then(data => {
        const dishDropdowns = document.getElementsByClassName('dish-select');
        for (let i = 0; i < dishDropdowns.length; i++) {
            dishDropdowns[i].innerHTML = '<option value="" selected>-- chọn--</option>';
            data.forEach(dish => {
                const option = document.createElement('option');
                option.value = dish.id;
                option.innerText = dish.name;
                dishDropdowns[i].appendChild(option);
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

function loadSummaryData() {
            const mealCategory = JSON.parse(localStorage.getItem('meal_category'));
            const numPeople = localStorage.getItem('num_people');
            const restaurant = JSON.parse(localStorage.getItem('restaurant'));
            const dishes = JSON.parse(localStorage.getItem('dishes'));

            document.getElementById('summary-meal-category').innerText = 'Meal Category: ' + mealCategory.name;
            document.getElementById('summary-num-people').innerText = 'Number of People: ' + numPeople;
            document.getElementById('summary-restaurant').innerText = 'Restaurant: ' + restaurant.name;

            const dishesList = document.getElementById('summary-dishes');
            dishesList.innerHTML = '';

            dishes.forEach(dish => {
                const listItem = document.createElement('li');
                listItem.innerText = `Dish: ${dish.name}, Servings: ${dish.servings}`;
                dishesList.appendChild(listItem);
            });
        }

        function submitFormData() {
            const mealCategory = JSON.parse(localStorage.getItem('meal_category'));
            const numPeople = localStorage.getItem('num_people');
            const restaurant = JSON.parse(localStorage.getItem('restaurant'));
            const dishes = JSON.parse(localStorage.getItem('dishes'));


            const data = {
                meal_category: mealCategory,
                num_people: numPeople,
                restaurant: restaurant,
                dishes: dishes
            };

        //   console.log(data);
            fetch('submit-form', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                alert('Form submitted successfully!');
                localStorage.clear();
                showStep(1);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
</script>



