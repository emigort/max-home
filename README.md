

## Max Home Test

This is a test from Max Home, below you can find the steps to run the Laravel Project


1. Clone the project from the Github repository
   ```
   git clone https://github.com/emigort/max-home
   ```
   
2. Create the .env file in the root directory and update your database credentials
    ```
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=max_home
    DB_USERNAME=root
    DB_PASSWORD=
    ```
3. Run the commands below in the cli
   ```
   composer install
   php artisan key:generate
   php artisan migrate
   php artisan db:seed
   php artisan serve
   ```
 ### Endpoints

1. To get the total annual income and bank account values for the application. parameter is the loan_application_id

    ```
    GET http://localhost:8000/api/loan/income_values/{id}
    ```
2. To create a Loan Application
    ```
    POST /api/loan HTTP/1.1
    Host: localhost:8000
    Content-Type: application/json
    Content-Length: 1221
    {
	"amount": "45000",
	"current_status": null,
	"borrowers": [{
			"first_name": "emilio",
			"last_name": "gort",
			"bank_accounts": [{
					"bank_name": "wells fargo",
					"amount": "100000"
				},
				{
					"bank_name": "bank of america",
					"amount": "120000"
				}
			],
			"annual_incomes": [{
					"income_type": "job",
					"amount": "130000"
				},
				{
					"income_type": "rental properties",
					"amount": "47000"
				}
			]
		},
		{
			"first_name": "John",
			"last_name": "Doe",
			"bank_accounts": [{
				"bank_name": "city bank",
				"amount": "210000"
			}],
			"annual_incomes": [{
				"income_type": "job",
				"amount": "110000"
			}]
        }
    ]
    }
    ```
    
### Run the test

1. To run the test run de command below. It's just to verify the json structure is correct

     ```
        php artisan test  
     ```
         
    
    

    

