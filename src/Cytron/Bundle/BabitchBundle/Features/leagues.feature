Feature: League Ressource

    Scenario: POST a league, GET it, then GET league listing, finally DELETE it
        Given I add "CONTENT_TYPE" header equal to "application/json"
        When I send a POST request on "/v1/leagues" with body:
            """
            {"name" : "Ligue 1"}
            """
        Then the response status code should be 201
        And the header "location" should be equal to "http://localhost/v1/leagues/1"

        When I send a GET request on "/v1/leagues/1"
        Then the response status code should be 200
        And the response should be in JSON
        And the JSON node "name" should be equal to "Ligue 1"

        When I send a GET request on "/v1/leagues"
        Then the response status code should be 200
        And the response should be in JSON
        And the JSON node "root[0].name" should be equal to "Ligue 1"

        When I send a DELETE request on "/v1/leagues/1"
        Then the response status code should be 204

        When I send a GET request on "/v1/leagues/1"
        Then the response status code should be 404

    Scenario: POST an invalid league (no name)
        Given I add "CONTENT_TYPE" header equal to "application/json"
        When I send a POST request on "/v1/leagues"
        Then the response status code should be 422
