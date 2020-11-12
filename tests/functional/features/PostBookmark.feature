Feature: PostBookmark
  Scenario: Test Post bookmark OK
    Given I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    When I send a "POST" request to "/api/bookmarks/" with body:
    """
    {
      "url": "https://vimeo.com/23846442"
    }
    """
    Then the response status code should be 201
