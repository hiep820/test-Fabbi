<head>
    <meta charset="UTF-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Multi-step Form</title>
@include('css.order')
</head>
<body onload="showStep(1)">
    <div class="container">
        <div id="step-1">
            <h1>Step 1: Select Meal Category and Number of People</h1>
            <form id="form-step-1" onsubmit="event.preventDefault(); showStep(2); saveStep1Data();">
                @csrf
                <label for="meal_category">Meal Category:</label>
                <select name="meal_category" id="meal_category" required>
                    <option value="" selected>----</option>
                    @foreach ($meals as $meal)
                    <option value="{{$meal->id}}">{{$meal->name}}</option>
                    @endforeach
                </select><br><br>
                <label for="num_people">Number of People:</label>
                <input type="number" name="num_people" id="num_people" min="1" max="10" required><br><br>
                <div class="button-container">
                    <button type="submit" style="margin-left: auto;">Next</button>
                </div>
            </form>
        </div>

        <div id="step-2" style="display: none;">
            <h1>Step 2: Select Restaurant</h1>
            <form id="form-step-2" onsubmit="event.preventDefault(); showStep(3); saveStep2Data();">
                @csrf
                <label for="restaurant">Restaurant:</label>
                <select name="restaurant" id="restaurant" required>

                </select><br><br>
                <div class="button-container">
                <button type="button" onclick="showStep(1); loadStep1Data();">Back</button>

                <button type="submit">Next</button>
                </div>
            </form>
        </div>

        <div id="step-3" style="display: none;">
            <h1>Step 3: Select Dish and Portions</h1>
            <form id="form-step-3" onsubmit="event.preventDefault(); validateAndShowStep4();">
                @csrf
                <div id="dishes-container">
                    <div class="dish-entry">
                        <label>Dish:</label>
                        <select name="dish[]" id="dish-1" class="dish-select" required>
                            <!-- Options will be dynamically populated -->
                        </select>
                        <label>Servings:</label>
                        <input type="number" name="servings[]" id="servings-1" class="servings-input" min="1" value="1" required>
                        <button type="button" onclick="removeDishEntry(this)">Remove</button>
                    </div>
                </div>
                <button type="button" onclick="addDishEntry()">+</button><br><br>
                <div class="button-container">
                    <button type="button" onclick="showStep(2); loadStep2Data();">Back</button>
                    <button type="submit">Next</button>
                </div>
            </form>
        </div>

        <div id="step-4" style="display: none;">
            <div class="container">
                <h1>Step 4: Review Your Information</h1>
                <div class="review-section">
                    <div class="review-item">
                        <h2>Meal Category:</h2>
                        <p id="summary-meal-category"></p>
                    </div>
                    <div class="review-item">
                        <h2>Number of People:</h2>
                        <p id="summary-num-people"></p>
                    </div>
                    <div class="review-item">
                        <h2>Selected Restaurant:</h2>
                        <p id="summary-restaurant"></p>
                    </div>
                    <div class="review-item">
                        <h2>Selected Dishes:</h2>
                        <ul id="summary-dishes"></ul>
                    </div>
                </div>
                <div class="button-container">
                    <button type="button" onclick="showStep(3);">Back</button>
                    <button type="button" onclick="submitFormData();">Submit</button>
                </div>
            </div>
        </div>

    </div>
</body>
@include('js.order')
</html>
