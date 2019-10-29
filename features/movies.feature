Feature: Getting information about movies
  In order to getting information about movies
  I should be able to read one movie and collection of the movies

  @createSchema
  Scenario: Get list of the movies
    Given There is a movie with a title "Forrest Gump"
    And There is a movie with a title "Kill Bill"
    When I add "Accept" header equal to "application/ld+json"
    And I add "Content-Type" header equal to "application/ld+json"
    And I send a "GET" request to "/api/movies"
    Then the response status code should be 200
    And the response should be in JSON
