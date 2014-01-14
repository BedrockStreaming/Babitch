Feature: Post Players Ressource

	Scenario: Create a player
		Given I add "CONTENT_TYPE" header equal to "application/json"
		When I send a POST request on "/v1/players" with body:
			"""
			{"name" : "raoul", "email" : "raoul@test.com"}
            """
        Then the response status code should be 201

    Scenario: Post an invalid player (no name)
		Given I add "CONTENT_TYPE" header equal to "application/json"
		When I send a POST request on "/v1/players" with body:
			"""
			{"email" : "raoul@test.com"}
            """
        Then the response status code should be 422

    Scenario: Post an invalid player (no email)
		Given I add "CONTENT_TYPE" header equal to "application/json"
		When I send a POST request on "/v1/players" with body:
			"""
			{"name" : "raoul"}
            """
        Then the response status code should be 422
