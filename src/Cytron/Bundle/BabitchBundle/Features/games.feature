Feature: Post new Game

    Background:
        Given I have players:
        |raoul1|raoul1@test.fr|
        |raoul2|raoul2@test.fr|
        |raoul3|raoul3@test.fr|
        |raoul4|raoul4@test.fr|

        Given I have leagues:
        |Ligue 1|


    Scenario: Create a new game
        Given I add "CONTENT_TYPE" header equal to "application/json"
        When I send a POST request on "/v1/games" with body:
            """
            {
                "league_id"  : 1,
                "blue_score" : 10,
                "red_score"  : 0,
                "started_at" : "2014-02-14 14:32:19",
                "ended_at"   : "2014-02-14 14:41:57",
                "player"     : [
                    {"team": "blue", "position" : "defense", "player_id" : 1 },
                    {"team": "blue", "position" : "attack", "player_id" : 2},
                    {"team": "red", "position" : "defense", "player_id" : 3},
                    {"team": "red", "position" : "attack", "player_id" : 4}
                ],
                 "goals": [
                    { "player_id": 1, "conceder_id": 3, "position": "attack", "autogoal": false, "scored_at": "2014-02-14 14:36:16" },
                    { "player_id": 1, "conceder_id": 3, "position": "attack", "autogoal": false },
                    { "player_id": 1, "conceder_id": 3, "position": "attack", "autogoal": false, "scored_at": "2014-02-14 14:36:36" },
                    { "player_id": 1, "conceder_id": 3, "position": "attack", "autogoal": false, "scored_at": "2014-02-14 14:36:46" },
                    { "player_id": 1, "conceder_id": 3, "position": "attack", "autogoal": false, "scored_at": "2014-02-14 14:36:56" },
                    { "player_id": 1, "conceder_id": 3, "position": "attack", "autogoal": false, "scored_at": "2014-02-14 14:37:16" },
                    { "player_id": 1, "conceder_id": 3, "position": "attack", "autogoal": false, "scored_at": "2014-02-14 14:37:36" },
                    { "player_id": 1, "conceder_id": 3, "position": "attack", "autogoal": false, "scored_at": "2014-02-14 14:39:16" },
                    { "player_id": 1, "conceder_id": 3, "position": "attack", "autogoal": false, "scored_at": "2014-02-14 14:40:16" },
                    { "player_id": 1, "conceder_id": 3, "position": "attack", "autogoal": false, "scored_at": "2014-02-14 14:41:57" }
                ]
            }
            """
        Then the response status code should be 201
        And the header "location" should be equal to "http://localhost/v1/games/1"

        When I send a GET request on "/v1/games/1"
        Then the response status code should be 200
        And the response should be in JSON
        And the JSON node "league_id" should be equal to "1"
        And the JSON node "blue_score" should be equal to "10"
        And the JSON node "red_score" should be equal to "0"
        And the JSON node "started_at" should be equal to "2014-02-14 14:32:19"
        And the JSON node "ended_at" should be equal to "2014-02-14 14:41:57"
        And the JSON node "goals[0].player_id" should be equal to "1"
        And the JSON node "goals[0].conceder_id" should be equal to "3"
        And the JSON node "goals[0].position" should be equal to "attack"
        And the JSON node "goals[0].autogoal" should be equal to "0"
        And the JSON node "goals[0].scored_at" should be equal to "2014-02-14 14:36:16"
        And the JSON node "goals[1].scored_at" should be equal to ""

        When I send a DELETE request on "/v1/games/1"
        Then the response status code should be 204

        When I send a GET request on "/v1/games/1"
        Then the response status code should be 404


    Scenario: Create a new game with default values
        Given I add "CONTENT_TYPE" header equal to "application/json"
        When I send a POST request on "/v1/games" with body:
            """
            {
                "blue_score" : 0,
                "red_score"  : 10,
                "player"     : [
                    {"team": "blue", "position" : "defense", "player_id" : 1 },
                    {"team": "blue", "position" : "attack", "player_id" : 2},
                    {"team": "red", "position" : "defense", "player_id" : 3},
                    {"team": "red", "position" : "attack", "player_id" : 4}
                ],
                 "goals": [
                    { "player_id": 1, "conceder_id": 3, "position": "attack", "autogoal": false },
                    { "player_id": 2, "conceder_id": 3, "position": "attack", "autogoal": false },
                    { "player_id": 1, "conceder_id": 3, "position": "attack", "autogoal": false },
                    { "player_id": 2, "conceder_id": 3, "position": "attack", "autogoal": false },
                    { "player_id": 1, "conceder_id": 3, "position": "attack", "autogoal": false },
                    { "player_id": 4, "conceder_id": 3, "position": "attack", "autogoal": true },
                    { "player_id": 1, "conceder_id": 4, "position": "attack", "autogoal": false },
                    { "player_id": 2, "conceder_id": 4, "position": "attack", "autogoal": false },
                    { "player_id": 1, "conceder_id": 4, "position": "attack", "autogoal": false },
                    { "player_id": 1, "conceder_id": 4, "position": "attack", "autogoal": false }
                ]
            }
            """
        Then the response status code should be 201
        And the header "location" should be equal to "http://localhost/v1/games/1"

        When I send a GET request on "/v1/games/1"
        Then the response status code should be 200
        And the response should be in JSON

        When I send a DELETE request on "/v1/games/1"
        Then the response status code should be 204

        When I send a GET request on "/v1/games/1"
        Then the response status code should be 404
