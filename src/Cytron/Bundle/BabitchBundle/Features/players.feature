Feature: Players Ressource

    Scenario: POST a player, GET it, then GET player listing, finnaly DELETE it
        Given I add "CONTENT_TYPE" header equal to "application/json"
        When I send a POST request on "/v1/players" with body:
            """
            {"name" : "raoul", "email" : "raoul@test.com"}
            """
        Then the response status code should be 201
        And the header "location" should be equal to "http://localhost/v1/players/1"
        When I send a GET request on "/v1/players/1"
        Then the response status code should be 200
        And the response should be in JSON
        And the JSON node "name" should be equal to "raoul"
        And the JSON node "email" should be equal to "raoul@test.com"
        When I send a GET request on "/v1/players"
        Then the response status code should be 200
        And the response should be in JSON
        And the JSON node "root[0].name" should be equal to "raoul"
        And the JSON node "root[0].email" should be equal to "raoul@test.com"
        When I send a DELETE request on "/v1/players/1"
        Then the response status code should be 204
        When I send a GET request on "/v1/players/1"
        Then the response status code should be 404


    Scenario: POST an invalid player (no name)
        Given I add "CONTENT_TYPE" header equal to "application/json"
        When I send a POST request on "/v1/players" with body:
            """
            {"email" : "raoul@test.com"}
            """
        Then the response status code should be 422

    Scenario: POST an invalid player (no email)
        Given I add "CONTENT_TYPE" header equal to "application/json"
        When I send a POST request on "/v1/players" with body:
            """
            {"name" : "raoul"}
            """
        Then the response status code should be 422
