Feature: An admin can manage movies
  In order to managing the movies
  I should be able to create, read and update the movies

  Scenario: Create a new movie
    Given I am on "/admin/movies/create"
    When I fill in "movie[title]" with "Kill Bill"
    And I fill in "movie[director]" with "Quentin Tarantion"
    And I fill in "movie[description]" with "Awesome movie!"
    And I attach the file "images/poster.jpg" to "movie[poster]"
    And I press "submit"
    Then I should see "Kill Bill"
    
  Scenario: View the movies
    Given There is a movie with a title "Kill bill"
    And I am on "/admin/movies"
    Then I should see "Kill Bill"
