Feature: Post new Game

    Background:
        Given I have players:
        |raoul1|raoul1@test.fr|
        |raoul2|raoul2@test.fr|
        |raoul3|raoul3@test.fr|
        |raoul4|raoul4@test.fr|

    Scenario: Create a new game
        Given I add "CONTENT_TYPE" header equal to "application/json"
        When I send a POST request on "/v1/games" with body:
            """
            {
                "blue_score" : 10,
                "red_score"  : 0,
                "player"     : [
                    {"team": "blue", "position" : "defense", "player_id" : 1 },
                    {"team": "blue", "position" : "attack", "player_id" : 2},
                    {"team": "red", "position" : "defense", "player_id" : 3},
                    {"team": "red", "position" : "attack", "player_id" : 4}
                ],
                 "goals": [
                    { "player_id": 1, "conceder_id": 3, "position": "attack", "autogoal": false },
                    { "player_id": 1, "conceder_id": 3, "position": "attack", "autogoal": false },
                    { "player_id": 1, "conceder_id": 3, "position": "attack", "autogoal": false },
                    { "player_id": 1, "conceder_id": 3, "position": "attack", "autogoal": false },
                    { "player_id": 1, "conceder_id": 3, "position": "attack", "autogoal": false },
                    { "player_id": 1, "conceder_id": 3, "position": "attack", "autogoal": false },
                    { "player_id": 1, "conceder_id": 3, "position": "attack", "autogoal": false },
                    { "player_id": 1, "conceder_id": 3, "position": "attack", "autogoal": false },
                    { "player_id": 1, "conceder_id": 3, "position": "attack", "autogoal": false },
                    { "player_id": 1, "conceder_id": 3, "position": "attack", "autogoal": false }
                ]
            }
            """
        Then the response status code should be 201
