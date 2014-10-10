Feature: API Doc

    Scenario: View API Doc
        When I send a GET request on "/api/doc/"
        Then the response status code should be 200
        And I should see "Babitch API"
        And I should see "Game"
        And I should see "Player"
