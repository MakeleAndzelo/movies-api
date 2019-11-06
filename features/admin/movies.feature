Feature: An admin can manage movies
  In order to managing the movies
  I should be able to create, read and update the movies

  @createSchema
  Scenario: Delete a movie
    Given There is a movie with a title "Kung fu panda"
    And I am on "/admin/movies"
    When I press "delete"
    Then I should not see "Kung fu panda"

  @createSchema
  Scenario: Create a new movie
    Given I am on the movie create page
    And I type title as "Kill Bill", director as "Quentin Tarantino" and description as "Awesome Movie!"
    And I attach a sample poster
    And I press "submit"
    Then I should see "Kill Bill"

  @createSchema
  Scenario: View the movies
    Given There is a movie with a title "Kill bill"
    And I am on "/admin/movies"
    Then I should see "Kill Bill"

  @createSchema
  Scenario: Edit a movie
    Given There is a movie with a title "Kill bill"
    And I am on "/admin/movies"
    When I follow "edit"
    And I fill in "movie[title]" with "Kill Bill 2"
    And I press "submit"
    Then I should see "Kill Bill 2"
